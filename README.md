# Stock Monitor and Portfolio Manager
A project created by me at NSIT Financial Hackathon in 8 hours.


- - -


* **Idea**

> The Idea behind this project was that there are several stock monitoring softwares but some of them are paid and rest of them do not     show the stocks of our interest or on our demand.
  My project gives live stock prices update and it also works as a Portfolio Manager where you can add the stocks you own, the price you   bought them at and the amount you own and it'll return you all the information about the corresponding stocks in **REAL TIME** and that   too for **FREE**.

* **How is it free ?**

> The Barchart Market Data Solutions API used by me gives me 2500 free API calls per day which means even if the webpage is run for 24     hours, I can refresh the page every 34 seconds, making it practically Real Time and Free.

#Detailed Working

* **Modify Page**

> Here you can enter the details of your stocks- Stock Symbol, the Price you bought it at, the Volume you bought.

![Alt-text](/Screenshots/1%20Blank%20Modify%20Page.png)


- - -


* **Portfolio Page**

> Your complete portfolio appears here as you add/delete stocks from Modification Page.
![Alt-text](/Screenshots/2%20Blank%20Portfolio%20Page.png)


- - -


* **Live Search Suggestions**

> If you don't remember the stock symbol but only the name of company, no need to worry with live search suggestions where you can see the stock symbol by searching for company name (works only if the company's stock name contains company's name; i.e, work for most of companies).
![Alt-text](/Screenshots/3%20Suggestion%20Feature.png)


- - -


* **Adding Values**

> Adding values is as simple as it gets. You just enter the details and press add.


> (Minimum requirement- For adding a value you have to fill all 3 columns for every value that you want to add.)

* **Why 5 input rows ?**

> 5 input rows are provided so that the user can enter or delete 5 values at a time making the modification process quicker. However, the choice is entirely upto user to fill any number of rows that he/she wants to.

![Alt-text](/Screenshots/5%20Fill%20one%20field%20of%20first%20row.png)

- - -

![Alt-text](/Screenshots/6%20Error%205.png)

- - -

![Alt-text](/Screenshots/7%20Add%20Value%20Demo.png)

- - -


> You know when the value is successfully added.

![Alt-text](/Screenshots/8%20One%20Value%20Added.png)

- - -


> The value appears in Portfolio on next refresh.
![Alt-text](/Screenshots/9%20One%20Value%20Port.png)

- - -


* **Unlimited Data Adding**

> With the project connected to MySQL database, you can enter as many entries as you want to.

![Alt-text](/Screenshots/10%20Unlimited%20Data%201.png)

- - -

![Alt-text](/Screenshots/11%20Unlimited%20Data%202.png)

- - -

![Alt-text](/Screenshots/12%20Unlimited%20Data%20Port%201.png)

- - -

![Alt-text](/Screenshots/13%20Unlimited%20Data%203.png)

- - -

![Alt-text](/Screenshots/14%20Unlimited%20Data%204.png)

- - -

![Alt-text](/Screenshots/15%20Unlimited%20Data%20Port%202.png)

- - -




* **Deleting Values**

> In this project, deleting values comes with incredible flexibilty and ease.
  For deleting values, the only required field is Symbol of stock !
  Rest all is user's choice; He/She may or may not fill any of the other fields.
  A demo of this process is shown in below shown images.

![Alt-text](/Screenshots/16%20Delete%20Demo%201.png)

- - -

![Alt-text](/Screenshots/17%20Delete%20Demo%202.png)

- - -

![Alt-text](/Screenshots/18%20Delete%20Demo%20Port.png)
