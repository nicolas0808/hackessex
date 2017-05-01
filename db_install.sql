/*	Find-Me-A-Drink is a simple web application that uses an image recognition API (clarifai.com) to provide suggestions
	on what drink to have with the type of food you provided be it an uploaded image, a link to an image or query.
    Copyright (C) 2017 Nicolas Kadis, Marios Iacovou, Alex Orphanides, Chris Petrou

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>. */
	
DROP DATABASE IF EXISTS food_and_drink;
CREATE DATABASE food_and_drink;


USE food_and_drink;



CREATE TABLE Alcoholic (
	Name VARCHAR(25) NOT NULL,
	Image_Loc VARCHAR(50),
	PRIMARY KEY(Name)
);


CREATE TABLE NonAlcoholic (
	Name VARCHAR(25) NOT NULL,
	Image_Loc VARCHAR(50),
	PRIMARY KEY(Name)
);


CREATE TABLE Food (
	Name VARCHAR(20)NOT NULL,
    AD_Name VARCHAR(25),
	NAD_Name VARCHAR(25),
	PRIMARY KEY(Name),
	FOREIGN KEY(AD_Name) REFERENCES Alcoholic(Name),
	FOREIGN KEY(NAD_Name) REFERENCES NonAlcoholic(Name)
);


INSERT INTO Alcoholic VALUES ('dry white wine','dry-white.png');
INSERT INTO Alcoholic VALUES ('sweet white wine','sweet-white.png');
INSERT INTO Alcoholic VALUES ('rich white wine','rich-white.png');
INSERT INTO Alcoholic VALUES ('sparkling wine','sparkling.png');
INSERT INTO Alcoholic VALUES ('light red wine','light-red.png');
INSERT INTO Alcoholic VALUES ('medium red wine','medium-red.png');
INSERT INTO Alcoholic VALUES ('bold red wine','bold-red.png');
INSERT INTO Alcoholic VALUES ('dessert wine','dessert.png');
INSERT INTO Alcoholic VALUES ('pale lager beer','pale-lager.png');
INSERT INTO Alcoholic VALUES ('blonde ale beer','blonde-ale.png');
INSERT INTO Alcoholic VALUES ('hefeweizen beer','hefeweizen.png');
INSERT INTO Alcoholic VALUES ('pale ale beer','pale-ale.png');
INSERT INTO Alcoholic VALUES ('ipa beer','blonde-ale.png');
INSERT INTO Alcoholic VALUES ('amber ale beer','amber-ale.png');
INSERT INTO Alcoholic VALUES ('irish red ale beer','irish-red-ale.png');
INSERT INTO Alcoholic VALUES ('brown ale beer','brown-ale.png');
INSERT INTO Alcoholic VALUES ('porter beer','porter.png');
INSERT INTO Alcoholic VALUES ('stout beer','stout.png');



INSERT INTO NonAlcoholic VALUES ('coke','coke.png');
INSERT INTO NonAlcoholic VALUES ('pepsi','pepsi.png');
INSERT INTO NonAlcoholic VALUES ('sprite','sprite.png');
INSERT INTO NonAlcoholic VALUES ('7up','7up.png');
INSERT INTO NonAlcoholic VALUES ('fanta','fanta.png');
INSERT INTO NonAlcoholic VALUES ('lemonade','lemonade.png');
INSERT INTO NonAlcoholic VALUES ('coffee','coffee.png');
INSERT INTO NonAlcoholic VALUES ('juice','juice.png');
INSERT INTO NonAlcoholic VALUES ('tea','tea.png');
INSERT INTO NonAlcoholic VALUES ('water','water.png');
INSERT INTO NonAlcoholic VALUES ('ice tea','ice-tea.png');



INSERT INTO Food VALUES ('meat','medium red wine','coke');
INSERT INTO Food VALUES ('chicken','blonde ale beer','lemonade');
INSERT INTO Food VALUES ('beef','bold red wine','pepsi');
INSERT INTO Food VALUES ('pork','brown ale beer','coke');
INSERT INTO Food VALUES ('turkey','rich white wine','7up');
INSERT INTO Food VALUES ('duck','brown ale beer','coke');
INSERT INTO Food VALUES ('lamb','light red wine','coke');
INSERT INTO Food VALUES ('fish','rich white wine','water');
INSERT INTO Food VALUES ('rabbit','pale ale beer','coke');
INSERT INTO Food VALUES ('quail','brown ale beer','coke');
INSERT INTO Food VALUES ('salmon','porter beer','water');
INSERT INTO Food VALUES ('pasta','pale ale beer','sprite');
INSERT INTO Food VALUES ('rice','bold red wine','ice tea');
INSERT INTO Food VALUES ('cheese','sweet white wine','tea');
INSERT INTO Food VALUES ('vegetable','dry white wine','tea');
INSERT INTO Food VALUES ('salad','dry white wine','water');
INSERT INTO Food VALUES ('bread','rich white wine','water');
INSERT INTO Food VALUES ('fruit','medium red wine','ice tea');
INSERT INTO Food VALUES ('beans','hefeweizen beer','sprite');
INSERT INTO Food VALUES ('noodles','pale lager beer','sprite');
INSERT INTO Food VALUES ('cake','dessert wine','coffee');
INSERT INTO Food VALUES ('nuts','pale lager beer','sprite');
INSERT INTO Food VALUES ('seeds','pale lager beer','7up');
INSERT INTO Food VALUES ('pizza','pale lager beer','pepsi');
INSERT INTO Food VALUES ('sausage','pale ale beer','coke');
INSERT INTO Food VALUES ('potatoe','dry white wine','water');
INSERT INTO Food VALUES ('soup','dry white wine','water');
INSERT INTO Food VALUES ('burger','amber ale beer','coke');
INSERT INTO Food VALUES ('dessert','dessert wine','coffee');
INSERT INTO Food VALUES ('sweet','dessert wine','coffee');
INSERT INTO Food VALUES ('sandwich','pale lager beer','juice');
INSERT INTO Food VALUES ('chocolate','stout beer','coffee');