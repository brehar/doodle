<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Welcome to Doodle</title>
        <meta name="description" content="Search the web for sites and images." />
        <meta name="keywords" content="Search engine, doodle, websites" />
        <meta name="author" content="Brett Hartman" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
	<body>
		<div class="wrapper indexPage">
			<div class="mainSection">
				<div class="logoContainer">
					<img src="assets/images/doodleLogo.png" alt="Doodle Logo" />
				</div>
				<div class="searchContainer">
					<form action="search.php" method="GET">
						<input type="text" class="searchBox" name="term" title="Enter your search term(s)..." />
						<input type="submit" class="searchButton" value="Search" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
