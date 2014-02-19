##Digital Signage UAL

This work is licensed under a [Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
You are free to share & remix, but you must make attribution and you may not sell it.

This Wordpress theme is based very largely on [Nate Jones' Digital Signage theme](http://pixelydo.com/work/wordpress-digital-signage/), but adds category-aware displays, to allow the same theme to be used at  multiple colleges, each with their own identities.


##How to set up digital signs

1. Set your Wordpress blog to use this theme.

2. In Wordpress create one of the following categories, according to your college:

    ```'csm', 'lcc', lcf', 'chelsea', 'wimbledon', 'camberwell'```
    
3. Create an empty page, with an appropriate title, e.g. 'CSM'

4. When editing that page, in the ```Digital Signage Display Settings``` box, select the category you created in step 2.

5. Make some posts. Set each post to have the category from step 2.

6. (Optional) Use the ```Digital Signage Panel Options``` box for that post to set the post features.

7. To add an image to a post, use the ```Featured Post``` option.

8. To display the posts as signs, visit the page you created in step 3.

##Additional notes

The display pages are designed to include the [ox-calendar](https://github.com/ox-it/ox-calendar-widget) widget on the right part of the page.
**Important: you must set ````private $fileReadTimeOut = 10;```` in class.iCalReader.php to make ox-calendar work. The default value of 1 is too low when behind a web proxy.**

Expiry dates can be set on posts using [ox-post-scheduler](https://github.com/ox-it/ox-post-scheduler) plugin. 

The display page refreshes every hour, so any expired posts will be removed.
See the readme for more info. about widgets.

**The rest of this readme is from Nate Jones original documentation.**

.

.

.



##Adaptive Images
We're using Matt Wilcox's [Adaptive Images](http://adaptive-images.com) for low-bandwidth images.

You'll need to edit the .htaccess in your Wordpress root directory (A sample .htaccess is in the AdaptiveImages_STUFF-TO-MOVE folder)
You'll also need to move adaptive-images.php (in the AdaptiveImages_STUFF-TO-MOVE folder) to your Wordpress root directory


##Widgets
So, I like four widgets in the footer, but feel free to change up functions.php & $('.row article.widget').last().removeClass().addClass(); in app.js if you want.

###Weather
Drag a text widget into the Footer. Paste in the following div:

    <div id="weather" class="twelve columns"></div>
    
Set the weather location and other variables in weather.php.
The javascript timer for the weather widget is in footer.php to allow it to find the correct path to weather.php.

###Clock
Drag a text widget into the Footer. Paste in the following div:

    <div class="clock">
	<ul>
		<li id="hours"> </li>
		<li id="point">:</li>
		<li id="min"> </li>
		<li id="point">:</li>
		<li id="sec"> </li>
	</ul>
	<div id="Date"></div>
    </div>
    
[thanks to @Bluxart](http://www.alessioatzeni.com/blog/css3-digital-clock-with-jquery)


###Twitter
Not currently working due to change in Twitter's API.