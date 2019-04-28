## P3 Peer Review

+ Reviewer's name: Ram Ramarolahy
+ Reviwee's name:  Gregory R.
+ URL to Reviewe's P3 Github Repo URL: *<https://github.com/gjrett/p3>*

## 1. Interface
+ **Initial thoughts on the interface**:<br>
 I think the choice of font, color, and assets (images) asks for a very particular layout and design. You might have wanted to make it look more oldschool, but I wouldn't have chosen blue on blue for the navigation bar for example. White on blue would have been more readable. The navbar links could also be reordered.<br>
 [ Home Birthdays About contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;login signup]<br>
 Also empty pages (birthdays, login ...) should have been omitted until they are functional and only show the functional ones.
+ **UI that did not work as expected**:<br>
 The navbar links do not behave as expected. The two fonts and color for active and nonactive links do not match. The home page and the birthdays OR birthdays and Add a birthday pages could be combined.<br>
 I think the dropdown could have had keyboard functionality (keypress corresponding month initial letter) if you removed the > character at the beginning.<br>
 After adding a new birthday, I do not know where I am anymore because it takes me to an endpoint (/process) that is not included on the available links on the navbar. I think this should have been directed to the birthdays page.
 + **UI that worked well**:<br>
 I think the Add birthday form works well.
 + **Other improvement suggestions**:<br>
 Other than the improvements I mentioned above, I would change the design of the navbar because right now it is hard to make sense of.<br>
 I would also move the clipart to a different location, and maybe use one instead of two.

## 2. Functional testing
+ **Submit with no data**:<br>
The error messages are placed under each field so that's good. My eyes got directed to the Bootstrap alert at the bottom though, and THEN I looked at the individual ones which could be an extra [unnecessary] step. I would just use the individual errors.
+ **Submit with some correct input**:<br>
The input fields kept correct data so that's good.
+ **Input types**:<br>
The input for day of the month could use a drop down instead I think, or at least do not allow the user to enter numbers with more than 2 digits. Same for the year input.

## 3. Code: Routes
None

## 4. Code: Views
+ Template inheritance is used
+ Create.blade.php has some variable initialization that could happen in the controller
+ The includes/ folder has files that should be in the controllers/ folder. Files that would be in the includes/ folder could be header.blade.php, head.blade.php ...
+ ```<?php ?>``` tags are still used throughout the views files eg. create.blade.php. Those could be replaced with blade for consistency purpose.


## 5. Code: General
+ I see unused code (with $books variable) in the BirthdayController.php that is misplaced. Maybe pasted from foobooks from the course for reference?
+ The readme.md file does not meet the requirements
+ Code files have bad organization and consistency overall.

## 6. Misc
None
