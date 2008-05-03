# Motivation

Normally when I create a new website with code on it, I write it as static files.  I'd take all the stuff that stayed the same on each page (header, footer, sidebar generally) and shove it into external files, which can then be included into each page manually.

Of course you end up forgetting to add an `include()` here and there, and the website breaks until you fix it.  So I got fed up and started looking at full blown CMS's.

After testing a couple out, I realised why I'd hate them.  They are all *(generally)* database based.  Its a good idea for multiple people editing, etc, but its a pain in the arse to backup.  You have to export your data from the database & then backup that file.  Then you have to either remember to do that every so often, or when data is updated.

Plus when you are testing you have to keep messing around with databases in setting them up and deleting them.  And I thought, "Why can't a website be file based, but not have to be so dependent on includes?"

Then I started to realise something.  All web based CMS's that use a database work inherently different at a basic level to static file inclusion systems.  They pull the content **into** the layout, rather than the layout into the content.

For example, wordpress pulls the content straight out of the database in the form of posts & pages, and inserts it into the theme (layout) before rendering it to the browser.

With the including system, I am requesting the layout (header.php, footer.php, etc) from within the content (about.php, etc), so I am sucking the layout *into* the content.

But what, I thought, if there was a system that used files, but still pulled the content into the layout, so each file *only* contained the content for that page.

And thus I wrote Soco.

# Usage

* Clone the git repo by running `git clone git://github.com/caius/soco.git`

* Edit the content files in */content*
