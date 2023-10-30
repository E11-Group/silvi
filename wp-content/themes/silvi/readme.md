#Development Guidelines  <img src="https://e11group.com/wp-content/uploads/2016/08/color1.png" width="100"> 


## Getting Started

Create document first using semantic dom structure, and then style.
It's important to use class names properly.
Minimalism is key. Rely upon mixins when possible.

Modules and components should be complete, styled, functional, and work independent of other modules and templates - though
it is okay to minimally rely upon styling elements such as buttons, typography, etc.

It is appropriate to use a class name when defining a component or module that needs to stand alone. When possible, seek
out a HTML5 element that could serve a better purpose than a div with a class.

Use structured data and aria roles/tags when you can.
http://getschema.org/index.php/Main_Page
http://searchengineland.com/how-to-use-rich-snippets-structured-markup-for-high-powered-seo-99081
http://www.deque.com/blog/aria-blog-series-landmark-roles-page-structure/

Examples:
```html
<!-- article inside a loop -->
<article class="archive-{posttypename}" itemscope itemType="http://schema.org/BlogPosting">
	<header>
		<h1 itemprop="headline"></h1>
		<time>
			<meta itemprop="datePublished" content="2011-06-02T16:00Z"/>
		</time>
	</header>
	<section itemprop="articleBody">
		<p></p>
	</section>
	<section class="dark">
		<h4></h4>
	</section>
	<footer></footer>
</article>
<!-- END -->
```
```html
<!-- single article -->
<article class="single-{posttypename}" role="main" itemscope itemType="http://schema.org/BlogPosting">
	<header>
		<h1 itemprop="headline"></h1>
		<time>
			<meta itemprop="datePublished" content="2011-06-02T16:00Z"/>
		</time>
	</header>
	<section itemprop="articleBody">
		<p></p>
	</section>
	<footer></footer>
</article>
<!-- END -->
```

## Front-end Guidelines
Everything we build should be modular and written with durable code. That means you should be able to use it throughout the site without it breaking.

CSS that is dependent on HTML tags or order of elements is considered fragile code.
 
One tip is to use a container per module instead of using a container for the entire page. That way if one of the modules expands outside of the container its very easy to develop.

```html
<section class="module-name">
	<div class="container"> //this provides a consistent container for all modules
		//Module markup goes here
	</div>
</section>
```
This allows you to easily target any container to adjust attributes, too:
```sass
.moduleName {
	.container {
		max-width: none;
	}
}
```

---

We also try to stay away from writing SASS that is heavily nested, such as:
```sass
// Wrong approach
.module {
	&__name {
		&--here {
		
		}
	}
}
```
Unnecessary nesting creates more specificity than needed, adds bloat and can make searching for classnames difficult. You should rarely be nesting past 2 levels.

The following approach eliminates excessive nesting and makes it very easy to search for classnames. It also makes it easy to update styles based on the classname of a parent element.

```sass
// Correct approach
.module {
	
}

.module__name {
	
}

.module__name--here {
	
	.module--active & {
		// can easily update styles based on the classname  
		// of a parent element 
	}
}
```
Never target an element by the type of element. Always target an element by its classname.
```sass
// Wrong approach
.module {
	 p {
	    color: #000;
	 }
}

// Correct approach
.module {
	 
}

.module__title {
	 color: #000;
}

```


---
###### © Eleven11 Group 2019
