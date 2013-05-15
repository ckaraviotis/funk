#                                funk
#                             D.28112012
            
What is it?
-----------

funk is a very simple blogging platform. It's designed from the ground up to be single user, and very straightforward to use. funk is written entirely in PHP, and isn't reliant on any external database software.

Because funk is hip and trendy, it uses Markdown for rendering it's posts. This allows you to just write your posts as text files, and funk will do the rest.

I install this how?
-------------------

I'd like to think this is fairly idiot proof, but I'm sure someone will prove me wrong.

- Get the latest version from somewhere. Here's a serving suggestion  
    
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
wget http://kchris.uni.cx/latest_funk.tar.gz
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    
- Extract that sucker. You'll want to do this inside your websites root folder (or the subfolder you're running it out of I guess)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
tar xzf latest_funk.tar.gz /var/www/
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

- You're done.

But how do I use it?
--------------------

Fire up your web browser and open up the index page that's provided. It should look pretty boring, and have basically no content. That's good!

Inside your installation folder, you should see a subfolder called "posts". Create a new text file in that folder. Put some text or html inside that text file. I don't care what you put in it. Text will be rendered to html using Markdown, html will be rendered as html. Here's an example of what you could put in there: <p>Hello world</p>.

Now refresh the index page in your browser. Oh, isn't that magical?

There are a few elements you should see there. A title, a body text, a date and a category. The category should say "General". The title should be the same as the name of the text file, with a bit of formatting jiggery-pokery. Any _'s in the filename will be converted to spaces.

Now, go ahead and make a new directory inside the "posts" dir. Call it 'test posts' or something. Move the text file you created into that folder, then refresh the index page.

Oh look, the post category has changed! Spiffy.

So, a quick summary.

1. Post title comes from the file name.
2. Post category comes from the folder.
3. Post date comes from the last modified date of the file.
4. Post content is Markdown or HTML, and is the contents of the file.

But my blog looks shit!
-----------------------

Yeah, you're gonna want to style that yourself. funk itself has no "themes" or styling built in. The index.php that I've provided has some very very basic styling. The idea is just to show you how to put the PHP in the right places.

So, read through the index.php (it's not big). I've commented it to redundancy and back, so it should be pretty easy to understand.

If you don't understand HTML and CSS, you're going to run into a bit of a problem styling it. Sorry!

Hey, I know this shit, just tell me what functions I need to use
----------------------------------------------------------------

funk has been minimized to one function. Put this code into the element of your choice (I suggest a <section\> or a <div\>).

~~~
 <?php echo GetAllPosts(); ?>
~~~

That will output every post as an article, with a header and footer.  The Article has "class=post", and the Category has a span class="category", to aid you with CSS styling.

What's the deal with that scary version number?
-----------------------------------------------

TLDR: It should start with an R.

I hate version numbers. The standard major/minor/bugfix/(build) irritates me to no end. What's a major vs minor feature? How does that vary from context to context? It's too much hassle. So! My version number is split into two parts.

        LETTER.NUMBER
        
The letter is representative of the release TYPE. D = Dev, T = Testing. R = Release. If your version doesn't start with an R, you should probably not be using it.

The number is the date. I use dd-mm-yyyy, because I'm english and that's the way that intuitively makes sense to me.

-------------------------------------------------------------------------------
Copyright (C) 2012, Christian Karaviotis  
See LICENSE.txt for more details. 