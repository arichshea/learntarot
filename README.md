# learntarot

## Question types:
1) show card, pick correct meanings
2) show meaning, pick correct card 

## topics:
Level 1: Normal
major arcana
	intro lesson 
	practice lesson 
suits
	intro lesson
	practice lesson 
	master lesson
numbers
	intro lesson 
	practice lesson 

cups court
pentacles court 
swords court 
wands court 
cups - numbers
pentacles - numbers 
swords - numbers 
wands - numbers 

intro lesson - each card in topic and meanings 
practice lessons - random cards and half good meanings, half bad 
master lesson - just cards, meanings must be typed 
Getting master perfect unlocks next level
Level 2: Reversals
 

## database:
Images:  Rider-Waite-Smith deck
Words: taken from https://labyrinthos.co/blogs/tarot-card-meanings-list


## flow is becoming clearer:
User arrives at intro page, clicks start learning
user gets: initial level, intro lesson 
Level and progress recorded in User cookie, saved to User database, user supplied with user code
User can choose intro, choose meanings, master meanings, choose cards, master cards, and master test
complete intro to unlock choose meanings, complete choose meanings without error to unlock master meanings, etc
so we have to either code a lesson structure, or a lesson system
lets just do a structure for now

so user.php needs a cookie


## database design;
table: cards
each row: img location, associated words, suit, number, name, reversed words
table Meanings:
each row:
	Meaning, cardName, orientation, suit, number, name, type
table: users
each row: userHash, passHash, email, img_location, session 

