<?php
    include('config.php');
    include('classes/SiteResultsProvider.php');

    if (isset($_GET['term'])) {
	    $term = $_GET['term'];
    } else {
        exit('You must enter a search term.');
    }

	$type = isset($_GET['type']) ? $_GET['type'] : 'sites';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
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
								<input type="text" class="searchBox" name="term" title="Enter your search term(s)..." value="<?php echo $term; ?>" />
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
            <div class="mainResultsSection">
                <?php
                    $resultsProvider = new SiteResultsProvider($con);
                    $pageSize = 20;
                    $numResults = $resultsProvider->getNumResults($term);

                    echo "<p class='resultsCount'>$numResults results found</p>";
                    echo $resultsProvider->getResultsHtml($page, $pageSize, $term);
                ?>
            </div>
            <div class="paginationContainer">
                <div class="pageButtons">
                    <div class="pageNumberContainer">
                        <img src="assets/images/pageStart.png" alt="D" />
                    </div>
                    <?php
                        $pagesToShow = 10;
                        $numPages = ceil($numResults / $pageSize);
                        $pagesLeft = min($pagesToShow, $numPages);
                        $currentPage = $page - floor($pagesToShow / 2);

                        if ($currentPage < 1) {
                            $currentPage = 1;
                        }

                        if ($currentPage + $pagesLeft > $numPages + 1) {
                            $currentPage = $numPages + 1 - $pagesLeft;
                        }

                        while ($pagesLeft != 0 && $currentPage <= $numPages) {
                            if ($currentPage == $page) {
	                            echo "<div class='pageNumberContainer'><img src='assets/images/pageSelected.png' alt='o' /><span class='pageNumber'>$currentPage</span></div>";
                            } else {
	                            echo "<div class='pageNumberContainer'><a href='search.php?term=$term&type=$type&page=$currentPage'><img src='assets/images/page.png' alt='o' /><span class='pageNumber'>$currentPage</span></a></div>";
                            }

                            $currentPage++;
                            $pagesLeft--;
                        }
                    ?>
                    <div class="pageNumberContainer">
                        <img src="assets/images/pageEnd.png" alt="dle" />
                    </div>
                </div>
            </div>
		</div>
	</body>
</html>
