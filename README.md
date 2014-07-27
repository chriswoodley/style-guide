# Pattern Library/Style Guide
The Front-end Pattern Library/Style Guide was the result of a changing industry and repition of code. During the development, I felt the need of some sort of methodology to organize my code. One of the requirements was to make the code DRY and reusable. I dove straight for Object Oriented CSS (OCSS). After reading several articles online (SMACCS, BEM, Nicole Sullivan OOCSS), I was convinced to adopt the BEM methodology and to integrate some organization techniques from SMACCS.

The result was a well structured library full of reusable CSS partials. I can pick and choose which partials to import into my main stylesheet. This helped cut down CSS bloat that usually plagues some CSS frameworks. The other side affect is that I don't have to code something over and over again. This helped my workflow tremendously.

This project was a great learning experience and I recommend any developer thinking about building their own Pattern Library/Style Guide to do it.

The application I used to build my project was the PHP implementation of [Knyle Style Sheets](http://warpspire.com/kss) (KSS). If you plan to use my library just install KSS and drop the style-guide directory inside the KSS install location.