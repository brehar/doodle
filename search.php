<?php
    if (isset($_GET['term'])) {
	    $term = $_GET['term'];
    } else {
        exit('You must enter a search term.');
    }

	$type = isset($_GET['type']) ? $_GET['type'] : 'sites';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Doodle Search Results</title>
        <meta name="description" content="Search the web for sites and images." />
        <meta name="keywords" content="Search engine, doodle, websites" />
        <meta name="author" content="Brett Hartman" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
	<body>
		<div class="wrapper">
			<div class="header">
				<div class="headerContent">
					<div class="logoContainer">
						<a href="index.php">
							<img src="assets/images/doodleLogo.png" alt="Doodle Logo" />
						</a>
					</div>
					<div class="searchContainer">
						<form action="search.php" method="GET">
							<div class="searchBarContainer">
								<input type="text" class="searchBox" name="term" title="Enter your search term(s)..." />
								<button class="searchButton">
                                    <img src="assets/images/icons/search.png" alt="Search" />
                                </button>
							</div>
						</form>
					</div>
				</div>
                <div class="tabsContainer">
                    <ul class="tabList">
                        <li class="<?php echo $type == 'sites' ? 'active' : ''; ?>">
                            <a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
                                Sites
                            </a>
                        </li>
                        <li class="<?php echo $type == 'images' ? 'active' : ''; ?>">
                            <a href='<?php echo "search.php?term=$term&type=images"; ?>'>
                                Images
                            </a>
                        </li>
                    </ul>
                </div>
			</div>
		</div>
	</body>
</html>
