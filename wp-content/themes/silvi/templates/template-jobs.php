<?php
/**
 * Template Name: Jobs Search Page
 *
 * @package silvi
 */
if(!defined('ABSPATH')) exit;
get_header();
the_content();
?>
<div class="jobs-form__header">
    <h1 class="jobs__title">Job Listings</h1>
    <p class="jobs__content">Here are our current job openings. Please click on the job title for more information, and apply from that page if you are interested. If you do not have a resume, please <a href="https://careerslongform-silvi.icims.com/jobs/search?hashed=-626006840&mobile=false&width=848&height=500&bga=true&needsRedirect=false&jan1offset=345&jun1offset=345">CLICK HERE</a> to submit your full application.</p>
</div>
<div class="jobs-form__subhead">
    <p>Use this form to perform another job search</p>
    <p>Start your job search here</p>
</div>

<form class="job__form" action="/jobs" method="post">
    <input type="text" placeholder="Start your job search here" class="search" name="career-search"/>
    <input type="search" value="search" class="btn-search" id="btn-search"/>

    <select>
        <option>all</option>
        <option>car</option>
    </select>

    <select>
        <option>all</option>
        <option>bus</option>
    </select>

    <strong>Search Result for 1 of 1</strong>
</form>
<?php
get_footer();