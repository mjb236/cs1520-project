<?php
$servername = "localhost";
$username = "bowen";
$password = "bowen1234";
$dbname = "testing";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

$sql = "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('The Brew Gentlemen Beer Company', '512 Braddock Avenue', 'Braddock', 'PA', '15104', '412-871-5075', '2014', 'http://www.brewgentlemen.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Bad Jimmy''s Brewing Company', '4358 B Leary Way NW', 'Seattle', 'WA', '98107', '206-789-1548', '2013', 'http://www.badjimmysbrewingco.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Hale''s Ales', '4301 Leary Way NW', 'Seattle', 'WA', '98107', '206-706-1572', '1983', 'http://www.halesbrewery.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Great Lakes Brewing Company', '2516 Market Avenue', 'Cleveland', 'OH', '44113', '216-771-4404', '1988', 'http://www.greatlakesbrewing.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Full Pint Brewing Company', '1963 Lincoln Highway', 'North Versailles', 'PA', '15137', '412-467-6414', '2009', 'http://www.fullpintbrewing.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Yards Brewing Company', '901 N Delaware Avenue', 'Philadelphia', 'PA', '19123', '215-634-2600', '1994', 'http://www.yardsbrewing.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Hitchhiker Brewing Company', '190 Castle Shannon Boulevard', 'Pittsburgh', 'PA', '15228', '412-343-1950', '2014', 'http://www.hitchhikerbrewing.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Spoonwood Brewing Company', '5981 Baptist Road', 'Pittsburgh', 'PA', '15236', '412-833-0333', '2014', 'http://www.spoonwoodbrewing.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Founders Brewing Company', '235 Grandville Avenue SW', 'Grand Rapids', 'MI', '49503', '616-776-1195', '1997', 'http://www.foundersbrewing.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Weyerbacher Brewing Company', '905 Line Street', 'Easton', 'PA', '18042', '610-559-5561', '1995', 'http://www.weyerbacher.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Rogue Ales Brewery', '2320 SE Marine Science Drive', 'Newport', 'OR', '97365', '541-867-3660', '1987', 'http://www.rogue.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Triple Rock Brewery & Alehouse', '1920 Shattuck Avenue', 'Berkeley', 'CA', '94704', '510-843-2739', '1985', 'http://www.triplerock.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Victory Brewing Company', '420 Acorn Lane', 'Downingtown', 'PA', '19335', '610-873-0881', '1996', 'http://www.victorybeer.com');";
$sql .= "INSERT INTO breweries (Name, Address1, City, State, ZIP, Phone, Established, Website)
VALUES ('Voodoo Brewing Company', '215 Arch Street', 'Meadville', 'PA', '16335', '814-337-3676', '2006', 'http://www.voodoobrewery.com');";

if ($db->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>