const chokidar = require('chokidar');
const fs = require('fs-extra');
const path = require('path');
const os = require('os');

// Define any patterns to ignore
const ignorePatterns = ['**/node_modules/**', '**/.git/**', '**/*.log'];

// Define source and target directories
const sourceDir = path.resolve(__dirname, 'wp-content/themes/silvi');
const localSitesDir = path.resolve(os.homedir(), '_Local Sites/silvi');
const targetDir = path.resolve(
  localSitesDir,
  'app/public/wp-content/themes/silvi'
);

// Check if target directory exists
if (!fs.existsSync(targetDir)) {
  console.error(`Target directory not found: ${targetDir}`);
  process.exit(1);
}

const sync = async (srcPath, destPath) => {
  try {
    // Ensure the destination directory exists
    await fs.ensureDir(path.dirname(destPath));

    // Copy the file or directory
    await fs.copy(srcPath, destPath, { overwrite: true });
    console.log(`Synced: ${srcPath} → ${destPath}`);
  } catch (err) {
    if (err.code === 'ENOENT') {
      console.warn(`Sync skipped: File not found - ${srcPath}`);
    } else {
      console.error(`Failed to sync ${srcPath} → ${destPath}:`, err);
    }
  }
};

const remove = async (destPath) => {
  try {
    // Check if the destination exists before attempting to remove it
    if (await fs.pathExists(destPath)) {
      await fs.remove(destPath);
      console.log(`Removed: ${destPath}`);
    } else {
      console.warn(`Remove skipped: File not found - ${destPath}`);
    }
  } catch (err) {
    if (err.code === 'ENOENT') {
      console.warn(`Remove skipped: File not found - ${destPath}`);
    } else {
      console.error(`Failed to remove ${destPath}:`, err);
    }
  }
};

// Sync queue to throttle operations
const syncQueue = [];
let processing = false;

// Process sync queue one at a time
const processQueue = async () => {
  if (processing || syncQueue.length === 0) return;
  processing = true;

  const { srcPath, destPath, action } = syncQueue.shift();
  try {
    if (action === 'sync') {
      await sync(srcPath, destPath);
    } else if (action === 'remove') {
      await remove(destPath);
    }
  } catch (err) {
    console.error(`Failed to process ${action} for ${srcPath}:`, err);
  } finally {
    processing = false;
    processQueue(); // Process the next item
  }
};

const queueOperation = (action, srcPath, destPath) => {
  syncQueue.push({ action, srcPath, destPath });
  processQueue();
};

// Watch for changes in the source directory
const watcher = chokidar.watch(sourceDir, {
  persistent: true,
  ignoreInitial: false, // Process initial files but throttle them
  depth: 10, // Adjust as needed for subdirectories
  ignored: (path) => {
    const isIgnored = ignorePatterns.some((pattern) =>
      new RegExp(pattern.replace(/\*\*/g, '.*')).test(path)
    );
    return isIgnored;
  },
});

let initialSyncComplete = false;

watcher
  .on('add', (filePath) => {
    const relativePath = path.relative(sourceDir, filePath);
    const destPath = path.join(targetDir, relativePath);
    queueOperation('sync', filePath, destPath);
  })
  .on('change', (filePath) => {
    const relativePath = path.relative(sourceDir, filePath);
    const destPath = path.join(targetDir, relativePath);
    queueOperation('sync', filePath, destPath);
  })
  .on('unlink', (filePath) => {
    const relativePath = path.relative(sourceDir, filePath);
    const destPath = path.join(targetDir, relativePath);
    queueOperation('remove', filePath, destPath);
  })
  .on('addDir', (dirPath) => {
    const relativePath = path.relative(sourceDir, dirPath);
    const destPath = path.join(targetDir, relativePath);
    queueOperation('sync', dirPath, destPath);
  })
  .on('unlinkDir', (dirPath) => {
    const relativePath = path.relative(sourceDir, dirPath);
    const destPath = path.join(targetDir, relativePath);
    queueOperation('remove', dirPath, destPath);
  })
  .on('ready', async () => {
    console.log('\n🎉 =============================== 🎉');
    console.log(
      '🚀 Initial scan complete. Waiting for sync operations to finish... 🚀'
    );
    console.log('🎉 =============================== 🎉\n');

    // Wait for the sync queue to empty
    const waitForQueue = async () => {
      if (syncQueue.length === 0 && !processing) {
        console.log('\n✅ =============================== ✅');
        console.log('👀 Initial sync complete. Watching for changes... 👀');
        console.log('✅ =============================== ✅\n');
      } else {
        setTimeout(waitForQueue, 100); // Check again after 100ms
      }
    };

    waitForQueue();
  })
  .on('error', (error) => console.error(`Watcher error: ${error}`));
