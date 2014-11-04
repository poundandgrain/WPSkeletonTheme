# Skeleton Wordpress theme

A wordpress theme for developers building a completely custom website. Comes with grunt tasks including:
- grunt-contrib-watch
- grunt-contrib-sass
- grunt-contrib-concat
- grunt-contrib-cssmin
- grunt-contrib-uglify
- grunt-pngmin
- grunt-grunticon
- grunt-svgmin

## Installation

[Install npm](http://blog.nodeknockout.com/post/65463770933/how-to-install-node-js-and-npm) if you don't already have it.

```
cd themes
git clone https://github.com/poundandgrain/WPSkeletonTheme.git name-of-your-theme
cd name-of-your-theme
rm -rf .git
npm install
```

Then edit name-of-your-theme/style.css and change Theme Name to your theme.

In order to create new [SVG icons](https://github.com/filamentgroup/grunticon), and to compile all Sass, JS, as well as every other task except for minification, run `grunt`.

Run `grunt watch` to compile JS and Sass as it changes.

Run `grunt deploy` to minify JS and CSS.

## JS includes:
- jQuery
- [Analytics.js](https://github.com/springload/Analytics.js)
- [Browser.js](https://github.com/JamesPlayer/Browser.js)
- [onMediaQuery.js](https://github.com/JoshBarr/on-media-query)
