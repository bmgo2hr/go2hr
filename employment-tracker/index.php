
<?php 
if  (!strstr($_SERVER["HTTP_HOST"],'localhost')){
  $tracker_dir = "/wp-content/uploads/employment-tracker";
}
else {
  $tracker_dir = "./";
}
?>
<!-- BOOTSTRAP -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- QUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- CHART.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>

<!-- CONTROLLERS -->
<script>
  <?php if  (!strstr($_SERVER["HTTP_HOST"],'localhost')){ ?>
    var dir = "/wp-content/uploads/employment-tracker"
  <?php } else { ?>
    var dir = "."
  <?php } ?>
</script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-1_sector-year.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-2_region-year.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-3_region-sector.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-4_occupation.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-5_characteristics.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-6_job-status.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-7_labour-force-sector.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-8_labour-force-region.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-9_unemployment.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-10_hours-worked.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-11_hourly-earnings.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-12_food-sales.js"></script>
<script src="<?php echo $tracker_dir; ?>/controllers/chart-13_hotel-occupancy.js"></script>

<!-- CUSTOM CSS -->
<link rel="stylesheet" type = "text/css" href="<?php echo $tracker_dir; ?>/chart.css">

<!-- ON PAGE JS -->
<script>

    function offsetAnchor() {
        if (location.hash == "#1") {
            window.scrollTo(window.scrollX, window.scrollY - 40);
        }
        if (location.hash == "#contents") {
            window.scrollTo(window.scrollX, window.scrollY - 75);
        }
    }

    // Captures click events of all <a> elements with href starting with #
    $(document).on('click', 'a[href^="#"]', function(event) {
        // Click events are captured before hashchanges. Timeout
        // causes offsetAnchor to be called after the page jump.
        window.setTimeout(function() {
            offsetAnchor();
        }, 0);
    });

    // Set the offset when entering page with hash present in the url
    window.setTimeout(offsetAnchor, 0);

    function formatNumberCells() {
        var cells = $(".table-content td");
        cells.each(function(index, cell){
            var val = $(cell).text().trim();
            if ($.isNumeric(val)) {
                if ($(cell).hasClass("c10")) {
                    val = Number.parseInt(val / 1000).toString();
                    $(cell).text(val.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "k");
                }
                else if (val > 1000 && !(val <= 2023 && val >=2017)) {
                    $(cell).text(val.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                }
                else if (val <= 1) {
                    $(cell).text((val * 100).toFixed(1) + "%");
                }
                else if (val > 10 && val < 40) {
                    $(cell).text("$" + Number.parseFloat(val).toFixed(2));
                }
            }
        });
    }

    function showVariationTable(){
        var button = document.getElementById("lfs-limitation-button");
        button.classList.add("collapsible--active");
        var content = button.nextElementSibling;
        content.style.maxHeight = content.scrollHeight + "px";

        $([document.documentElement, document.body]).animate({
            scrollTop: $("#variation-table").offset().top - 80
        }, 500);
    }

    function showRef(n, expandable){
        if (expandable) {
            var button = document.getElementById(expandable);
            button.classList.add("collapsible--active");
            var content = button.nextElementSibling;
            content.style.maxHeight = content.scrollHeight + "px";
        }

        $([document.documentElement, document.body]).animate({
            scrollTop: $("#ref-" + n).offset().top - 50
        }, 500);
    }

    $(document).ready(function(){
        var coll = document.getElementsByClassName("collapsible-table");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("collapsible--active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
        }
        
        coll = document.getElementsByClassName("collapsible-info");
        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("collapsible--active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
            content.style.maxHeight = null;
            } else {
            content.style.maxHeight = content.scrollHeight + "px";
            }
        });
        }
    });
</script>
        
    <div class="heading-pnel">
      <h2 class="no-space">Introduction</h2>
    </div>
    <p>The Employment Tracker reports on monthly changes in employment in the BC Tourism and Hospitality industry. The Tracker draws primarily from the Labour Force Survey (LFS), a monthly household survey conducted by Statistics Canada. The LFS is the most timely source of data on the labour market across Canada.</p>
    <a name="ref-2"></a>
    <p>go2HR receives LFS tables generated by Qatalyst Research Group via <a href="https://www.statcan.gc.ca/eng/microdata/rtra" target="_blank">Statistics Canada's Real Time Remote Access (RTRA) Program</a> that follows the <a href="https://www150.statcan.gc.ca/n1/pub/13-604-m/2017084/tbl/tblc1-eng.htm" target="_blank">Tourism Satellite Account’s definition of tourism</a>. This data enables go2HR to track changes in employment and major trends in the Tourism and Hospitality industry in BC and monitor the ongoing impact of COVID-19 on the Tourism and Hospitality industry.</p>

    <a id="contents"></a>
    <h3 class="contents__title">Contents</h3>
        <ul class="contents__list">
            <li><a href="#1">Chart 1: Employment By Sector, 2018-2023</a></li>
            <li><a href="#2">Chart 2: Employment By Region, 2018-2023</a></li>
            <li><a href="#3">Chart 3: Employment By Region and Sector, 2018-2023</a></li>
            <li><a href="#4">Chart 4: Leading Occupations By Sector, 2019-2023</a></li>
            <li><a href="#5">Chart 5: Employment By Selected Characteristics, 2023</a></li>
            <li><a href="#6">Chart 6: Employment By Job Status, 2019-2023</a></li>
            <li><a href="#7">Chart 7: Labour Force by Sector, 2019-2023</a></li>
            <li><a href="#8">Chart 8: Labour Force by Region, 2019-2023</a></li>
            <li><a href="#9">Chart 9: Unemployment Rate, 2019-2023</a></li>
            <li><a href="#10">Chart 10: Actual Hours Worked Per Week, 2019-2023</a></li>
            <li><a href="#11">Chart 11: Average Hourly Earnings, 2019-2023</a></li>
            <li><a href="#12">Chart 12: Sales Revenue of Food Services and Drinking Places, 2019-2023</a></li>
            <li><a href="#13">Chart 13: Hotel Occupancy Rate, 2019-2023</a></li>
        </ul>
    </p>
    
    <button type="button" id="lfs-limitation-button" class="collapsible collapsible-info">LFS Limitations</button>
    <div class="info-content">
        <p><em>Readers should be aware that the LFS is a sample survey and estimates are subject to both sampling and non-sampling errors.</em></p>
        <p>Statistics Canada develops national labour market projections based on a monthly LFS survey of 56,000 households, covering 100,000 individuals from across Canada. Data is available on a sector (aligned with specific NAICS codes) and regional basis (e.g. by development region within BC). While this sample size provides for statistically reliable projections at the national, provincial and industry levels, the results become less statistically reliable once data is presented at the sector and regional level within BC.</p>
        <p>As an illustration, BC accounts for about 12% of Canadian households and the Tourism and Hospitality sector typically employs about 12% of British Columbians. Applying these percentages, we would expect that about 1.4% of the individuals covered in the survey may be associated with the Tourism and Hospitality industry in BC (i.e. Of the 100,000 individuals captured in the household survey, about 1,400 would be associated with the Tourism and Hospitality industry in BC; this would provide a statistically reliable estimate of employment in the industry, equal to ± 2.6% at a confidence level of 95%). As the projections are broken down by sector within the industry and by development region within BC, the results are based on fewer and fewer surveys (and therefore become less statistically reliable). The results are also subject to rounding errors (e.g. results are reported in increments of 2,500).</p>
        <p>As such, readers should be cautious when interpreting results presented at the sector and regional levels, particularly for smaller sectors and regions where the results can vary significantly on a month to month basis.</p>
        <p>For additional information related to the LFS Study, please refer to the <a href="https://www150.statcan.gc.ca/n1/pub/71-543-g/71-543-g2020001-eng.htm" target="_blank">LFS User Guide</a>. For further information about statistical reliability, please refer to Table 7.1 (Coefficients of Variation) in the LFS User Guide. Generally speaking, the larger the count presented in a graph or table, the greater the statistical reliability. When the count (e.g. the number of people employed in the Food and Beverage sector) is greater than or equal to 39,600, the coefficient of variation (CV) is less than or equal to 10%; when the count in the range of 39,600 and 13,900, the CV is from 10% to 20%; and when the counts are below 10,000, the CV is typically 20% or above.</p>
        <table class="variation-table" id="variation-table">
            <thead>
                <tr>
                    <th>Count</th>
                    <th>Coefficient of Variation</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Over 322,500</td><td>1%</td></tr>
                <tr><td>113,001 to 322,500</td><td>2.5%</td></tr>
                <tr><td>61,201 to 113,000</td><td>5%</td></tr>
                <tr><td>39,601 to 61,200</td><td>7.5%</td></tr>
                <tr><td>18,601 to 39,600</td><td>10%</td></tr>
                <tr><td>13,901 to 18,000</td><td>16.5%</td></tr>
                <tr><td>9,901 to 13,900</td><td>20%</td></tr>
                <tr><td>6,401 to 9,900</td><td>25%</td></tr>
                <tr><td>6,400 or less</td><td>33%</td></tr>
            </tbody>
        </table>
        <p>For more information, please refer to Table 7.1 - Coefficient of variation (CV) for estimates of monthly totals, Canada and provinces, from the <a href="https://www150.statcan.gc.ca/n1/pub/71-543-g/71-543-g2020001-eng.htm" target="_blank">LFS User Guide</a>.</p>
    
    </div>

    <button type="button" class="collapsible collapsible-info" id="tourism-definitions-button">Definitions of the Tourism and Hospitality Industry </button>
    <div class="info-content"><a name="ref-1" id="ref-1"></a>
        <p>The North American Industry Classification System (NAICS) is an industry classification system developed by the statistical agencies of Canada, Mexico and the United States. Created against the background of the North American Free Trade Agreement, it is designed to provide common definitions of the industrial structure of the three countries and a common statistical framework to facilitate the analysis of the three economies. NAICS is based on supply-side or production-oriented principles, to ensure that industrial data, classified to NAICS, are suitable for the analysis of production-related issues such as industrial performance<a href="#footnote-1"><sup>[1]</sup></a>.</p>
        <p>
            This employment tracker follows the Tourism Satellite Account’s definition of Tourism and Hospitality sector, which is defined by the following NAICS codes:
            <ul>
                <li><b>Accommodation:</b></li>
                <ul>
                    <li>7211 Traveller accommodation</li>
                    <li>7212 Recreational vehicle (RV) parks and recreational camps</li>
                </ul>
                <li><b>Food and Beverage Services:</b></li>
                <ul>
                    <li>7224 Drinking places (alcoholic beverages)</li>
                    <li>7225 Full-service restaurants and limited-service eating places</li>
                </ul>
                <li><b>Recreation and Entertainment:</b></li>
                <ul>
                    <li>5121 Motion picture and video exhibition</li>
                    <li>7111 Performing arts companies</li>
                    <li>7112 Spectator sports</li>
                    <li>7115 Independent artists, writers and performers</li>
                    <li>7121 Heritage institutions</li>
                    <li>7131 Amusement parks and arcades </li>
                    <li>7132 Gambling industries</li>
                    <li>7139 Other amusement and recreation industries</li>
                </ul>
                <li><b>Transportation and Travel Services:</b></li>
                <ul>
                    <li>4811 Scheduled air transport</li>
                    <li>4812 Non-scheduled air transport</li>
                    <li>4821 Rail transportation</li>
                    <li>4831 Deep sea, coastal and great lakes water transportation</li>
                    <li>4832 Inland water transportation</li>
                    <li>4851 Urban transit systems</li>
                    <li>4853 Taxi and limousine service</li>
                    <li>4854 School and employee bus transportation</li>
                    <li>4855 Charter bus industry</li>
                    <li>4859 Other transit and ground passenger transportation</li>
                    <li>4871 Scenic and sightseeing transportation – land</li>
                    <li>4872 Scenic and sightseeing transportation – water</li>
                    <li>4879 Scenic and sightseeing transportation – other</li>
                    <li>5321 Automotive equipment rental and leasing</li>
                    <li>5615 Travel arrangement and reservation services</li>
                </ul>
            </ul>
        </p>
        <p>Further details can be found <a href="https://www150.statcan.gc.ca/n1/pub/13-604-m/2017084/tbl/tblc1-eng.htm" target="_blank">here</a>. Detailed definitions of the NAICS code can be found <a href="https://www23.statcan.gc.ca/imdb/p3VD.pl?Function=getVD&TVD=1181553" target="_blank">here</a>.</p>
    </div>

    <button type="button" class="collapsible collapsible-info">Map of BC Economic Development Regions</button>
    <div class="info-content">
        <p>LFS collects data from the eight economic development regions within British Columbia: North Coast, Nechako, Northeast, Cariboo, Vancouver Island/Coast, Mainland/Southwest, Thompson Okanagan, and the Kootenays. The following map shows the eight economic development regions in British Columbia.</p>
        <img src="<?php echo $tracker_dir; ?>/assets/regions_of_bc.jpg">
        <p>Source: <a href="https://pwp.vpl.ca/siic/job-search-resources/regions-of-british-columbia/">https://pwp.vpl.ca/siic/job-search-resources/regions-of-british-columbia/</a></p>
        <p>While there are eight development regions in BC, this employment tracker reports data for six regions:</p>
        <ul>
            <li>Cariboo</li>
            <li>Lower Mainland</li>
            <li>Northern BC (North Coast, Northeast, Nechako)</li>
            <li>Thompson Okanagan</li>
            <li>Kootenay</li>
            <li>Vancouver Island</li>
        </ul>
        <p>Three of the Northern regions (Northeast, North Coast, and Nechako) are sparsely sampled by the LFS, so the data for these regions are combined and defined to be Northern BC.</p>
        Comparison of Development Regions to Tourism Regions in BC
        <p>The map below compares the eight economic development regions (black uppercase text and transparent) to the six tourism regions (white text and coloured) in BC. The six tourism regions within British Columbia include Northern BC, Cariboo Chilcotin Coast, Vancouver Island, Vancouver Coast & Mountains, Thompson Okanagan, and Kootenay Rockies. The tourism regions align with the six regional destination marketing organizations in British Columbia. As indicated below, while there is some commonality between the two sets of regional definitions, no region aligns directly with their counterpart in the opposite set.</p>
        <img src="<?php echo $tracker_dir; ?>/assets/map2.jpg" width="608px">
        <p>Source: GO2HR. <a href="https://www.go2hr.ca/essential-tips-info/working-in-bc-tourism-regions">https://www.go2hr.ca/essential-tips-info/working-in-bc-tourism-regions</a>; <br>WorkBC. <a href="https://www.workbc.ca/labour-market-industry/regional-profiles.aspx">https://www.workbc.ca/labour-market-industry/regional-profiles.aspx</a>
    </div>
    


    <a id="1"></a>
    <div class="ChartBox">
    <h2>Chart 1: Employment By Sector, 2018-2023</h2>
    <div class="key-takeaways">
      <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
      <div class="key-takeaways-body">
        <ul>
          <li>Employment in BC’s Tourism and Hospitality sector decreased by 5.0% from 367,500 in August 2023 to 349,000 in September 2023. Tourism and Hospitality employment in BC has surpassed pre-COVID levels, with 12,000 more jobs compared to September 2019.</li>
        <ul>
      </div>
    </div>
    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 1 tracks monthly employment in BC’s Tourism and Hospitality sector since 2018. Users can select data for each sector at the right-hand side of the chart. Display options include line chart or bar chart. Users may also compare employment data across sectors for a single selected year. This option is available by clicking the Invert Options button at the bottom right of the chart window.</p>

        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> Please note: There is high variability in monthly industry sector data at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    
    <div id="sy_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="sy_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div id="sy_sectorRadios">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input  sy_sectorRadio" type="radio" name="sy_sectorRadio" value="Tourism" id="sy_tourismRadio" checked>
                    <label class="form-check-label" for="sy_tourismRadio">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_sectorRadio" type="radio" name="sy_sectorRadio" value="Accommodation" id="sy_accommodationRadio">
                    <label class="form-check-label" for="sy_accommodationRadio">
                        Accommodation 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_sectorRadio" type="radio" name="sy_sectorRadio" value="FoodBeverage" id="sy_foodBeverageRadio">
                    <label class="form-check-label" for="sy_foodBeverageRadio">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_sectorRadio" type="radio" name="sy_sectorRadio" value="RecreationEnter" id="sy_recreationRadio">
                    <label class="form-check-label" for="sy_recreationRadio">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_sectorRadio" type="radio" name="sy_sectorRadio" value="Transportation & Travel" id="sy_transportationRadio">
                    <label class="form-check-label" for="sy_transportationRadio">
                        Transportation and Travel
                    </label>
                </div>
            </div>
            <div id="sy_yearChecks">
                <h4>Years</h4>
                <div class="form-check">
                    <input class="form-check-input sy_yearCheck" type="checkbox" value="2018" id="sy_2018Check" >
                    <label class="form-check-label" for="sy_2018Check">
                        2018
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_yearCheck" type="checkbox" value="2019" id="sy_2019Check" >
                    <label class="form-check-label" for="sy_2019Check">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_yearCheck" type="checkbox" value="2020" id="sy_2020Check" >
                    <label class="form-check-label" for="sy_2020Check">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_yearCheck" type="checkbox" value="2021" id="sy_2021Check">
                    <label class="form-check-label" for="sy_2021Check">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_yearCheck" type="checkbox" value="2022" id="sy_2022Check" checked>
                    <label class="form-check-label" for="sy_2022Check">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_yearCheck" type="checkbox" value="2023" id="sy_2023Check" checked>
                    <label class="form-check-label" for="sy_2023Check">
                        2023
                    </label>
                </div>
            </div>
            <div id="sy_options-checkboxes">
                <h4>Style</h4>
                <div class="form-check">
                    <input class="form-check-input sy_styleRadio" type="radio" value="line" name="sy_styleRadio" id="sy_styleRadio-line" checked>
                    <label class="form-check-label" for="sy_styleRadio-line">
                        Lines
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sy_styleRadio" type="radio" value="bar" name="sy_styleRadio" id="sy_styleRadio-bar">
                    <label class="form-check-label" for="sy_styleRadio-bar">
                        Bars
                    </label>
                </div>
            </div>
            <button class="button btn btn-primary mtb" onclick="sy_invert()">Invert Options</button>
        </div>
    </div>
    <div id="ys_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ys_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div id="ys_yearRadios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input ys_yearRadio" type="radio" name="ys_yearRadio" value="2018" id="ys_2018Radio">
                    <label class="form-check-label" for="ys_2018Radio">
                        2018
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_yearRadio" type="radio" name="ys_yearRadio" value="2019" id="ys_2019Radio">
                    <label class="form-check-label" for="ys_2019Radio">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_yearRadio" type="radio" name="ys_yearRadio" value="2020" id="ys_2020Radio">
                    <label class="form-check-label" for="ys_2020Radio">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_yearRadio" type="radio" name="ys_yearRadio" value="2021" id="ys_2021Radio">
                    <label class="form-check-label" for="ys_2021Radio">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_yearRadio" type="radio" name="ys_yearRadio" value="2022" id="ys_2022Radio" checked>
                    <label class="form-check-label" for="ys_2022Radio">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_yearRadio" type="radio" name="ys_yearRadio" value="2023" id="ys_2023Radio" checked>
                    <label class="form-check-label" for="ys_2023Radio">
                        2023
                    </label>
                </div>
            </div>
            <div id="ys_sectorChecks">
                <h4>Sectors</h4>
                <div class="form-check">
                    <input class="form-check-input  ys_sectorCheck" type="checkbox" name="ys_sectorCheck" value="Tourism" id="ys_tourismCheck" checked>
                    <label class="form-check-label" for="ys_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_sectorCheck" type="checkbox" name="ys_sectorCheck" value="Accommodation" id="ys_accommodationCheck" >
                    <label class="form-check-label" for="ys_accommodationCheck">
                        Accommodation 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_sectorCheck" type="checkbox" name="ys_sectorCheck" value="FoodBeverage" id="ys_foodBeverageCheck" >
                    <label class="form-check-label" for="ys_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_sectorCheck" type="checkbox" name="ys_sectorCheck" value="RecreationEnter" id="ys_recreationCheck" >
                    <label class="form-check-label" for="ys_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_sectorCheck" type="checkbox" name="ys_sectorCheck" value="Transportation & Travel" id="ys_transportationCheck" >
                    <label class="form-check-label" for="ys_transportationCheck">
                        Transportation and Travel
                    </label>
                </div>
            </div>
            <div id="ys_options-checkboxes">
                <h4>Style</h4>
                <div class="form-check">
                    <input class="form-check-input ys_styleRadio" type="radio" value="line" name="ys_styleRadio" id="ys_styleRadio-line" checked>
                    <label class="form-check-label" for="ys_styleRadio-line">
                        Lines
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ys_styleRadio" type="radio" value="bar" name="ys_styleRadio" id="ys_styleRadio-bar">
                    <label class="form-check-label" for="ys_styleRadio-bar">
                        Bars
                    </label>
                </div>
            </div>
            <button class="button btn btn-primary mtb" onclick="sy_invert()">Invert Options</button>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="sy-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-3_employment_2018-2023.csv" download="bc_tourism_employment_2018-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="2"></a>
    <div class="ChartBox">
    <h2>Chart 2: Employment By Region, 2018-2023</h2>
    
    <div class="key-takeaways">
      <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>In September 2023, employment in BC’s Tourism and Hospitality sector decreased by 5.0% from 367,500 in August 2023. Employment change varied across all regions, increasing in Northern BC and Kootenay. Decreasing in Thompson Okanagan, Vancouver Island and the Lower Mainland regions and remaining unchanged in Cariboo.</li>
                <li>Tourism and Hospitality employment in September 2023 in all regions, except the Lower Mainland region, remained below pre-COVID levels. </li>
            </ul>
        </div>
    </div>

    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 2 displays Tourism and Hospitality employment information for each of the economic development regions in BC Users can select data for each region at the right-hand side of the chart. Display options include line chart or bar chart. Users may also compare employment data across regions for a single selected year. This option is available by clicking the Invert Options button at the bottom right of the chart window.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly industry sector data at the regional level, typically higher than the variability at the provincial level. Coefficient of Variation for BC estimates can be found  <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    <div id="ry_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ry_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div id="ry_regionRadios">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="BC" name="ry_regionRadio" id="ry_bc" checked>
                    <label class="form-check-label" for="ry_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="Cariboo" name="ry_regionRadio" id="ry_cariboo" >
                    <label class="form-check-label" for="ry_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="LowerMain" name="ry_regionRadio" id="ry_lowerMainland" >
                    <label class="form-check-label" for="ry_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="Northern BC" name="ry_regionRadio" id="ry_northernBC" >
                    <label class="form-check-label" for="ry_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="ThompOkan" name="ry_regionRadio" id="ry_thompOkan" >
                    <label class="form-check-label" for="ry_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="Kootenay" name="ry_regionRadio" id="ry_kootenay" >
                    <label class="form-check-label" for="ry_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_regionRadio" type="radio" value="VanIsdCos" name="ry_regionRadio" id="ry_vanIsdCos" >
                    <label class="form-check-label" for="ry_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            <div id="ry_yearChecks">
                <h4>Years</h4>
                <div class="form-check">
                    <input class="form-check-input ry_yearCheck" type="checkbox" value="2018" id="ry_2018Check" >
                    <label class="form-check-label" for="ry_2018Check">
                        2018
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_yearCheck" type="checkbox" value="2019" id="ry_2019Check" >
                    <label class="form-check-label" for="ry_2019Check">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_yearCheck" type="checkbox" value="2020" id="ry_2020Check" >
                    <label class="form-check-label" for="ry_2020Check">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_yearCheck" type="checkbox" value="2021" id="ry_2021Check">
                    <label class="form-check-label" for="ry_2021Check">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_yearCheck" type="checkbox" value="2022" id="ry_2022Check" checked>
                    <label class="form-check-label" for="ry_2022Check">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_yearCheck" type="checkbox" value="2023" id="ry_2023Check" checked>
                    <label class="form-check-label" for="ry_2023Check">
                        2023
                    </label>
                </div>
            </div>
            <div id="ry_options-checkboxes">
                <h4>Style</h4>
                <div class="form-check">
                    <input class="form-check-input ry_styleRadio" type="radio" value="line" name="ry_styleRadio" id="ry_styleRadio-line" checked>
                    <label class="form-check-label" for="ry_styleRadio-line">
                        Lines
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ry_styleRadio" type="radio" value="bar" name="ry_styleRadio" id="ry_styleRadio-bar">
                    <label class="form-check-label" for="ry_styleRadio-bar">
                        Bars
                    </label>
                </div>
            </div>
            <button class="button btn btn-primary mtb" onclick="ry_invert()">Invert Options</button>
        </div>
    </div>
    <div id="yr_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="yr_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div id="yr_yearRadios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input yr_yearRadio" type="radio" value="2018" name="yr_yearRadio" id="yr_2018Radio" >
                    <label class="form-check-label" for="yr_2018Radio">
                        2018
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_yearRadio" type="radio" value="2019" name="yr_yearRadio" id="yr_2019Radio" >
                    <label class="form-check-label" for="yr_2019Radio">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_yearRadio" type="radio" value="2020" name="yr_yearRadio" id="yr_2020Radio" >
                    <label class="form-check-label" for="yr_2020Radio">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_yearRadio" type="radio" value="2021" name="yr_yearRadio" id="yr_2021Radio">
                    <label class="form-check-label" for="yr_2021Radio">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_yearRadio" type="radio" value="2022" name="yr_yearRadio" id="yr_2022Radio" >
                    <label class="form-check-label" for="yr_2022Radio">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_yearRadio" type="radio" value="2023" name="yr_yearRadio" id="yr_2023Radio" checked>
                    <label class="form-check-label" for="yr_2023Radio">
                        2023
                    </label>
                </div>
            </div>
            <div id="yr_regionChecks">
                <h4>Regions</h4>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="BC" id="yr_bcCheck" checked>
                    <label class="form-check-label" for="yr_bcCheck">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="Cariboo" name="yr_regionCheck" id="yr_caribooCheck" >
                    <label class="form-check-label" for="yr_caribooCheck">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="LowerMain" name="yr_regionCheck" id="yr_lowerMainlandCheck" >
                    <label class="form-check-label" for="yr_lowerMainlandCheck">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="Northern BC" name="yr_regionCheck" id="yr_northernBCCheck" >
                    <label class="form-check-label" for="yr_northernBCCheck">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="ThompOkan" name="yr_regionCheck" id="yr_thompOkanCheck" >
                    <label class="form-check-label" for="yr_thompOkanCheck">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="Kootenay" name="yr_regionCheck" id="yr_kootenayCheck" >
                    <label class="form-check-label" for="yr_kootenayCheck">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_regionCheck" type="checkbox" value="VanIsdCos" name="yr_regionCheck" id="yr_vanIsdCosCheck" >
                    <label class="form-check-label" for="yr_vanIsdCosCheck">
                        Vancouver Island
                    </label>
                </div>
            </div>
            <div id="yr_options-checkboxes">
                <h4>Style</h4>
                <div class="form-check">
                    <input class="form-check-input yr_styleRadio" type="radio" value="line" name="yr_styleRadio" id="yr_styleRadio-line" checked>
                    <label class="form-check-label" for="yr_styleRadio-line">
                        Lines
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input yr_styleRadio" type="radio" value="bar" name="yr_styleRadio" id="yr_styleRadio-bar">
                    <label class="form-check-label" for="yr_styleRadio-bar">
                        Bars
                    </label>
                </div>
            </div>
            <button class="button btn btn-primary mtb" onclick="ry_invert()">Invert Options</button>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="ry-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-3_employment_2018-2023.csv" download="bc_tourism_employment_2018-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="3"></a>
    <div class="ChartBox">
    <h2>Chart 3: Employment By Region and Sector, 2018-2023</h2>

    <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>Employment in all sectors, except Recreation and Entertainment, have decreased in September 2023.</li>
                <li>Among all Tourism and Hospitality sectors, the Food and Beverage and Recreation and Entertainment sectors have surpassed pre-COVID levels (September 2019) in terms of employment.</li>
            </ul>
        </div>
    </div>

    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 3 displays the same employment information but for each of the Tourism and Hospitality sectors and economic development regions in BC since 2018. For each region and year, users can select data for multiple sectors at the right-hand side of the chart. Users may also compare employment data across regions for any selected sector and year. This option is available by clicking the Invert Options button at the bottom right of the chart window.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly industry sector data at the regional level, typically higher than the variability at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>. Due to the small sample in the region and sector data reported by the LFS, Thompson-Okanagan and Kootenay are combined only for reporting purposes and are combined only on this chart.</p></div>
    </div>
    

        <div id="rs_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="rs_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div id="regions-checkboxes">
                <h4>Region</h4>
                <select  class="form-select" name="rs_regionSelect" id="rs_regionSelect">
                    <option value="BC" selected>BC (all)</option>
                    <option value="Cariboo">Cariboo</option>
                    <option value="LowerMain">Lower Mainland</option>
                    <option value="Northern BC">Northern BC</option>
                    <option value="ThompOkan & Kootenay">Thompson Okanagan and Kootenay</option>
                    <option value="VanIsdCos"> Vancouver Island</option>
                </select>
            </div>
            <div id="rs_yearRadios">
                <h4>Year</h4>
                <select  class="form-select" name="rs_yearSelect" id="rs_yearSelect">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023" selected>2023</option>
                </select>
            </div>
            <div id="sectors-checkboxes">
                <h4>Sectors</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Tourism" id="rs_tourismCheck" checked>
                    <label class="form-check-label" for="rs_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input rs_sectorCheck" type="checkbox" value="Accommodation" id="rs_accommodationCheck">
                    <label class="form-check-label" for="rs_accommodationCheck">
                        Accommodation 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input rs_sectorCheck" type="checkbox" value="FoodBeverage" id="rs_foodBeverageCheck">
                    <label class="form-check-label" for="rs_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input rs_sectorCheck" type="checkbox" value="Recreation" id="rs_recreationCheck">
                    <label class="form-check-label" for="rs_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input rs_sectorCheck" type="checkbox" value="Transportation & Travel" id="rs_transportationCheck">
                    <label class="form-check-label" for="rs_transportationCheck">
                        Transportation and Travel
                    </label>
                </div>
            </div>
            <div id="options-checkboxes">
                <h4>Style</h4>
                <div class="form-check">
                    <input class="form-check-input rs_styleRadio" type="radio" value="stacked" name="rs_styleRadio" id="rs_styleRadio-stacked" checked>
                    <label class="form-check-label" for="rs_styleRadio-stacked">
                        Stacked
                    </label>
                </div><div class="form-check">
                    <input class="form-check-input rs_styleRadio" type="radio" value="side-by-side" name="rs_styleRadio" id="rs_styleRadio-sideBySide">
                    <label class="form-check-label" for="rs_styleRadio-sideBySide">
                        Side by Side
                    </label>
                </div>
            </div>
            <button class="button btn btn-primary mtb" onclick="rs_invert()">Invert Options</button>
        </div>
    </div>
    <div id="sr_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="sr_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div id="sectors-radios">
                <h4>Sector</h4>
                <select  class="form-select" name="sr_sectorSelect" id="sr_sectorSelect">
                    <option value="Tourism">Tourism and Hospitality (all)</option>
                    <option value="Accommodation">Accommodation</option>
                    <option value="FoodBeverage">Food and Beverage</option>
                    <option value="RecreationEnter">Recreation and Entertainment</option>
                    <option value="Transportation & Travel">Transportation and Travel</option>
                </select>
            </div>
            <div id="sr_yearRadios">
                <h4>Year</h4>
                <select  class="form-select" name="sr_yearSelect" id="sr_yearSelect">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023" selected>2023</option>
                </select>
            </div>
            <div id="regions-checkboxes">
                <h4>Regions</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="BC" name="sr_regionCheck" id="sr_bc" checked>
                    <label class="form-check-label" for="sr_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sr_regionCheck" type="checkbox" value="Cariboo" name="sr_regionCheck" id="sr_cariboo" >
                    <label class="form-check-label" for="sr_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sr_regionCheck" type="checkbox" value="LowerMain" name="sr_regionCheck" id="sr_lowerMainland" >
                    <label class="form-check-label" for="sr_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sr_regionCheck" type="checkbox" value="Northern BC" name="sr_regionCheck" id="sr_northernBC" >
                    <label class="form-check-label" for="sr_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sr_regionCheck" type="checkbox" value="ThompOkan & Kootenay" name="sr_regionCheck" id="sr_thompOkan" >
                    <label class="form-check-label" for="sr_thompOkan">
                    Thompson Okanagan and Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sr_regionCheck" type="checkbox" value="VanIsdCos" name="sr_regionCheck" id="sr_vanIsdCos" >
                    <label class="form-check-label" for="sr_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            <div id="options-checkboxes">
                <h4>Style</h4>
                <div class="form-check">
                    <input class="form-check-input sr_styleRadio" type="radio" value="stacked" name="sr_styleRadio" id="sr_styleRadio-stacked" checked>
                    <label class="form-check-label" for="sr_styleRadio-stacked">
                        Stacked
                    </label>
                </div><div class="form-check">
                    <input class="form-check-input sr_styleRadio" type="radio" value="side-by-side" name="sr_styleRadio" id="sr_styleRadio-sideBySide">
                    <label class="form-check-label" for="sr_styleRadio-sideBySide">
                        Side by Side
                    </label>
                </div>
            </div>
            <button class="button btn btn-primary mtb" onclick="rs_invert()">Invert Options</button>
        </div>
    </div>
    
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="rs-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-3_employment_2018-2023.csv" download="bc_tourism_employment_2018-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="4"></a>
    <div class="ChartBox">
    <h2>Chart 4: Leading Occupations By Sector, 2019-2023</h2>
    <div class="key-takeaways">
       <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>Leading occupations (those that reported a greater employment weight) in the Tourism and Hospitality industry in BC include Creative and performing artists; Photographers, graphic arts technicians and technical and co-ordinating occupations in motion pictures, broadcasting and the performing arts; Athletes, coaches, referees and related occupations; Service Supervisors; Chefs and cooks; Occupations in food and beverage service; Occupations in travel and accommodation; Cashiers; Food counter attendants, kitchen helpers and related support occupations; Cleaners; Machinery and transportation equipment mechanics; and Motor vehicle and transit drivers.</li>
                <li>More than half of the leading occupations are still experiencing lower employment levels compared to their pre-COVID employment levels in 2019. However, employment in some leading occupations such as Photographers, graphic arts technicians and technical and co-ordinating occupations in motion pictures, broadcasting and the performing arts; Creative designers and craftspersons; Creative and performing artists; Retail sales supervisors; Food counter attendants, kitchen helpers and related support occupations; and Service supervisors remain higher than their 2019 levels. Care must be used in interpreting the data given that the Coefficient of Variation for each of the reported occupations is from 20% to well over 35%.</li>
                <li>Although employment levels among all four Tourism and Hospitality industry sectors have been impacted by COVID-19, leading occupations in Food and Beverage Services have recovered back to the normal level, however, occupations in Travel and Accommodation Services remained about 11% below pre-COVID levels.</li>
                <li>Various occupations exist in multiple sectors. For example, chefs and cooks exist in both Accommodation and Food and Beverage sectors, while the Food and Beverage sector accounted for a higher percentage of the overall chefs and cooks employed in the industry.</li>
            </ul>
        </div>
    </div>

    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 4 shows employment levels broken down by leading occupations (in 3-digits NOCs) for each Tourism and Hospitality sector in BC Users can select data for each sector at the right-hand side of the chart. Users may also compare employment data across multiple sectors for any selected occupation. This chart also provides an option to show year over year changes in employment levels of a sector’s leading occupations. This provides a comparison of pre and post pandemic employment levels in selected occupations and sectors. This option is available by selecting Across Years under Display.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        Detailed information of the Canadian NOC codes can be found <a href="https://noc.esdc.gc.ca/">here</a>.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> Some occupations may result in a large sampling error, to accompany this issue to some degree, the chart also provides an option to display 3-months moving averages. However, users should still note the high variability in monthly occupational data at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    

    <div id="so_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="so_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="occupation-radios">
                <h4>Display</h4>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-sector occ_radio1" type="radio" value="sector" name="occ_radio1" id="occ_radio-sector1" checked>
                    <label class="form-check-label" for="occ_radio-sector1">
                        Single Sector, 2023
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-years occ_radio1" type="radio" value="years" name="occ_radio1" id="occ_radio-years1">
                    <label class="form-check-label" for="occ_radio-years1">
                        Across Years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-across occ_radio1" type="radio" value="across" name="occ_radio1" id="occ_radio-across1" >
                    <label class="form-check-label" for="occ_radio-across1">
                        Across Sectors, 2023
                    </label>
                </div>
            </div>
            <div id="sectors-radios">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input so_sectorRadio" type="radio" value="Tourism" name="so_sectorRadio" id="so_tourismRadio" checked>
                    <label class="form-check-label" for="so_tourismRadio">
                        Tourism and Hospitality 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input so_sectorRadio" type="radio" value="Accommodation" name="so_sectorRadio" id="so_accommodationRadio" checked>
                    <label class="form-check-label" for="so_accommodationRadio">
                        Accommodation 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input so_sectorRadio" type="radio" value="FoodBeverage" name="so_sectorRadio" id="so_foodBeverageRadio">
                    <label class="form-check-label" for="so_foodBeverageRadio">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input so_sectorRadio" type="radio" value="RecreationEnter" name="so_sectorRadio" id="so_recreationRadio">
                    <label class="form-check-label" for="so_recreationRadio">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input so_sectorRadio" type="radio" value="Transportation & Travel" name="so_sectorRadio" id="so_transportationRadio">
                    <label class="form-check-label" for="so_transportationRadio">
                        Transportation and Travel
                    </label>
                </div>
            </div>
            <div id="options-checkboxes">
                <h4>Data Source</h4>
                <div class="form-check">
                    <input class="form-check-input so_rollingRadio" type="radio" value="false" name="so_rollingRadio" id="so_rollingRadio-false" checked>
                    <label class="form-check-label" for="so_rollingRadio-false">
                        Sep Value<!--update-->
                    </label>
                </div><div class="form-check">
                    <input class="form-check-input so_rollingRadio" type="radio" value="true" name="so_rollingRadio" id="so_rollingRadio-true">
                    <label class="form-check-label" for="so_rollingRadio-true">
                        Jul - Sep Rolling Average<!--update-->
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="sos_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="sos_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="occupation-radios">
                <h4>Display</h4>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-sector occ_radio3" type="radio" value="sector" name="occ_radio3" id="occ_radio-sector3" checked>
                    <label class="form-check-label" for="occ_radio-sector3">
                        Single Sector, 2023
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-years occ_radio3" type="radio" value="years" name="occ_radio3" id="occ_radio-years3">
                    <label class="form-check-label" for="occ_radio-years3">
                        Across Years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-across occ_radio3" type="radio" value="across" name="occ_radio3" id="occ_radio-across3" >
                    <label class="form-check-label" for="occ_radio-across3">
                        Across Sectors, 2023
                    </label>
                </div>
            </div>
            <div id="sectors-radios">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input sos_sectorRadio" type="radio" value="Tourism" name="sos_sectorRadio" id="sos_tourismRadio" checked>
                    <label class="form-check-label" for="sos_tourismRadio">
                        Tourism and Hospitality 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sos_sectorRadio" type="radio" value="Accommodation" name="sos_sectorRadio" id="sos_accommodationRadio" checked>
                    <label class="form-check-label" for="sos_accommodationRadio">
                        Accommodation 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sos_sectorRadio" type="radio" value="FoodBeverage" name="sos_sectorRadio" id="sos_foodBeverageRadio">
                    <label class="form-check-label" for="sos_foodBeverageRadio">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sos_sectorRadio" type="radio" value="RecreationEnter" name="sos_sectorRadio" id="sos_recreationRadio">
                    <label class="form-check-label" for="sos_recreationRadio">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input sos_sectorRadio" type="radio" value="Transportation & Travel" name="sos_sectorRadio" id="sos_transportationRadio">
                    <label class="form-check-label" for="sos_transportationRadio">
                        Transportation and Travel
                    </label>
                </div>
            </div>
            <div id="options-checkboxes">
                <h4>Data Source</h4>
                <div class="form-check">
                    <input class="form-check-input sos_rollingRadio" type="radio" value="false" name="sos_rollingRadio" id="sos_rollingRadio-false" checked>
                    <label class="form-check-label" for="sos_rollingRadio-false">
                        Sep Value<!--update-->
                    </label>
                </div><div class="form-check">
                    <input class="form-check-input sos_rollingRadio" type="radio" value="true" name="sos_rollingRadio" id="sos_rollingRadio-true">
                    <label class="form-check-label" for="sos_rollingRadio-true">
                        Jul - Sep Rolling Average<!--update-->
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="occ_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="occ_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="occupation-radios">
                <h4>Display</h4>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-sector occ_radio2" type="radio" value="sector" name="occ_radio2" id="occ_radio-sector2" checked>
                    <label class="form-check-label" for="occ_radio-sector2">
                        Single Sector, 2023
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-years occ_radio2" type="radio" value="years" name="occ_radio2" id="occ_radio-years2">
                    <label class="form-check-label" for="occ_radio-years2">
                        Across Years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_radio occ_radio-across occ_radio2" type="radio" value="across" name="occ_radio2" id="occ_radio-across2" >
                    <label class="form-check-label" for="occ_radio-across2">
                        Across Sectors, 2023
                    </label>
                </div>
            </div>
            <div id="occupation-checks">
                <h4>Occupations</h4>
                <div class="form-check">
                    <input class="form-check-input occ_occCheck" type="checkbox" value="Accommodation service managers" name="occ_occCheck" id="occ_063Check" checked>
                    <label class="form-check-label" for="occ_063Check">
                    Accommodation service managers
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_occCheck" type="checkbox" value="Service supervisors" name="occ_occCheck" id="occ_631Check" checked>
                    <label class="form-check-label" for="occ_631Check">
                    Service supervisors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_occCheck" type="checkbox" value="Chefs and cooks" name="occ_occCheck" id="occ_632Check" checked>
                    <label class="form-check-label" for="occ_632Check">
                    Chefs and cooks
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input occ_occCheck" type="checkbox" value="Occupations in travel and accommodation" name="occ_occCheck" id="occ_652Check" checked>
                    <label class="form-check-label" for="occ_652Check">
                    Occupations in travel and accommodation
                    </label>
                </div>
            </div>
            <div id="options-checkboxes">
                <h4>Data Source</h4>
                <div class="form-check">
                    <input class="form-check-input occ_rollingRadio" type="radio" value="false" name="occ_rollingRadio" id="occ_rollingRadio-false" checked>
                    <label class="form-check-label" for="occ_rollingRadio-false">
                        Sep Value<!--update-->
                    </label>
                </div><div class="form-check">
                    <input class="form-check-input occ_rollingRadio" type="radio" value="true" name="occ_rollingRadio" id="occ_rollingRadio-true">
                    <label class="form-check-label" for="occ_rollingRadio-true">
                        Jul - Sep Rolling Average<!--update-->
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="occ-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-4_leading_occupations_2023.csv" download="bc_tourism_leading_occupations_2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="5"></a>
    <div class="ChartBox">
    <h2>Chart 5: Employment By Selected Characteristics, September 2023<!--update--></h2>
    <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>Of those employed in BC’s Tourism and Hospitality industry, 49% are male and 51% are female. The Transportation and Travel Services sector, however, has a higher concentration of males. About 69% of workers are between 15 to 44 years of age. Most workers in BC’s Tourism and Hospitality industry have at least a High School Diploma, 26% have a degree or diploma below a bachelor’s, and 31% have a bachelor’s degree or higher.</li>
            </ul> 
        </div>
    </div>

    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 5 presents a series of employment distributions in BC’s Tourism and Hospitality Sector by selected characteristics such as gender, age group, and education levels. Data is presented for the latest available month: April 2021. User may switch between charts by selecting an option under Characteristics at the top right of the chart window.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly industry sector data at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    
    <div class="row chart-and-controls" id="gender_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="gender_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="char-radios">
                <h4>Characteristic</h4>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-gender char_radio1" type="radio" value="gender" name="char_radio1" id="char_radio-gender1" checked>
                    <label class="form-check-label" for="char_radio-gender1">
                        Gender
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-age char_radio1" type="radio" value="age" name="char_radio1" id="char_radio-age1" >
                    <label class="form-check-label" for="char_radio-age1">
                        Age
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-edu char_radio1" type="radio" value="edu" name="char_radio1" id="char_radio-edu1">
                    <label class="form-check-label" for="char_radio-edu1">
                        Education
                    </label>
                </div>
            </div>
            <div class="display-radio">
                <h4>Display</h4>
                <div class="form-check">
                    <input class="form-check-input gender_displayRadio" type="radio" value="raw" name="gender_displayRadio" id="gender_displayRadio-raw" checked>
                    <label class="form-check-label" for="gender_displayRadio-raw">
                        Raw
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input gender_displayRadio" type="radio" value="percentage" name="gender_displayRadio" id="gender_displayRadio-percentage">
                    <label class="form-check-label" for="gender_displayRadio-percentage">
                        Percentage 
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="age_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="age_chart" width="300" height="200"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="char-radio">
                <h4>Characteristic</h4>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-gender char_radio2" type="radio" value="gender" name="char_radio2" id="char_radio-gender2">
                    <label class="form-check-label" for="char_radio-gender2">
                        Gender
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-age char_radio2" type="radio" value="age" name="char_radio2" id="char_radio-age2" >
                    <label class="form-check-label" for="char_radio-age2">
                        Age
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-edu char_radio2" type="radio" value="edu" name="char_radio2" id="char_radio-edu2">
                    <label class="form-check-label" for="char_radio-edu2">
                        Education
                    </label>
                </div>
            </div>
            <div id="sectors-checkboxes">
                <h4>Sectors</h4>
                <div class="form-check">
                    <input class="form-check-input age_sectorCheck" type="checkbox" value="Tourism" id="age_tourismCheck" checked>
                    <label class="form-check-label" for="age_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input age_sectorCheck" type="checkbox" value="Accommodation" id="age_accommodationCheck">
                    <label class="form-check-label" for="age_accommodationCheck">
                        Accommodation 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input age_sectorCheck" type="checkbox" value="FoodBeverage" id="age_foodBeverageCheck">
                    <label class="form-check-label" for="age_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input age_sectorCheck" type="checkbox" value="Recreation" id="age_recreationCheck">
                    <label class="form-check-label" for="age_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input age_sectorCheck" type="checkbox" value="Transportation & Travel" id="age_transportationCheck">
                    <label class="form-check-label" for="age_transportationCheck">
                        Transportation and Travel
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="edu_chart-and-controls" class="row chart-and-controls">
        <div class="col-lg-9">
            <canvas id="edu_chart" width="300" height="200"></canvas>
        </div>
        <div class="col-lg-3">
            <div class="char-radio">
                <h4>Characteristic</h4>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-gender char_radio3" type="radio" value="gender" name="char_radio3" id="char_radio-gender3">
                    <label class="form-check-label" for="char_radio-gender3">
                        Gender
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-age char_radio3" type="radio" value="age" name="char_radio3" id="char_radio-age3" >
                    <label class="form-check-label" for="char_radio-age3">
                        Age
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input char_radio char_radio-edu char_radio3" type="radio" value="edu" name="char_radio3" id="char_radio-edu3">
                    <label class="form-check-label" for="char_radio-edu3">
                        Education
                    </label>
                </div>
            </div>
        </div>
    </div>
    
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="char-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-5_characteristics_2023.csv" download="bc_tourism_by_characteristics_2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="6"></a>
    <div class="ChartBox">
    <h2>Chart 6: Employment By Job Status, 2019-2023</h2>
    <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>While overall employment in the Tourism and Hospitality industry decreased by 5.0% in September 2023, the percentage of workers employed full-time also decreased from 71% in August to 65% in September 2023.</li>
                <li>In September 2023, Transportation and Travel led BC tourism sectors with approximately 82% full-time workers, as compared to a low of 57% full-time workers in the Food and Beverage sector.</li>
            </ul>
        </div>  
    </div>


    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 6 tracks monthly full time and part time employment in BC’s Tourism and Hospitality sector since 2019. This chart has three display options, which can be toggled at the lower right-hand side of the chart. The first option displays the total employment as well as the percentage of full time and part time workers; while this option is selected, a single a single year and sector can be displayed at a time. The second option shows all sectors at once, and allows the user to select as single year and status at a time. The third option shows all years at once, and allows the user to select a single status and sector at a time.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly industry sector data at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    <div class="row chart-and-controls" id="js0_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="js0_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input js0_yearRadio" type="radio" value="2019" name="js0_yearRadio" id="js0_2019">
                    <label class="form-check-label" for="js0_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_yearRadio" type="radio" value="2020" name="js0_yearRadio" id="js0_2020">
                    <label class="form-check-label" for="js0_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_yearRadio" type="radio" value="2021" name="js0_yearRadio" id="js0_2021">
                    <label class="form-check-label" for="js0_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_yearRadio" type="radio" value="2022" name="js0_yearRadio" id="js0_2022" checked>
                    <label class="form-check-label" for="js0_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_yearRadio" type="radio" value="2023" name="js0_yearRadio" id="js0_2023" checked>
                    <label class="form-check-label" for="js0_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input js0_sectorRadio" type="radio" value="Tourism" name="js0_sectorRadio" id="js0_tourism" checked>
                    <label class="form-check-label" for="js0_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_sectorRadio" type="radio" value="Accommodation" name="js0_sectorRadio" id="js0_accommodation">
                    <label class="form-check-label" for="js0_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_sectorRadio" type="radio" value="FoodBeverage" name="js0_sectorRadio" id="js0_food">
                    <label class="form-check-label" for="js0_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_sectorRadio" type="radio" value="RecreationEnter" name="js0_sectorRadio" id="js0_rec">
                    <label class="form-check-label" for="js0_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_sectorRadio" type="radio" value="Transportation & Travel" name="js0_sectorRadio" id="js0_transportation">
                    <label class="form-check-label" for="js0_transportation">
                    Transportation and Travel
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input js0_pageRadio js_page0" type="radio" value="0" name="js0_pageRadio" id="js0_0" checked>
                    <label class="form-check-label" for="js0_0">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_pageRadio js_page1" type="radio" value="1" name="js0_pageRadio" id="js0_1">
                    <label class="form-check-label" for="js0_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js0_pageRadio js_page2" type="radio" value="2" name="js0_pageRadio" id="js0_2">
                    <label class="form-check-label" for="js0_2">
                        Show all years
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="js1_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="js1_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input js1_yearRadio" type="radio" value="2019" name="js1_yearRadio" id="js1_2019">
                    <label class="form-check-label" for="js1_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_yearRadio" type="radio" value="2020" name="js1_yearRadio" id="js1_2020">
                    <label class="form-check-label" for="js1_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_yearRadio" type="radio" value="2021" name="js1_yearRadio" id="js1_2021">
                    <label class="form-check-label" for="js1_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_yearRadio" type="radio" value="2022" name="js1_yearRadio" id="js1_2022">
                    <label class="form-check-label" for="js1_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_yearRadio" type="radio" value="2023" name="js1_yearRadio" id="js1_2023" checked>
                    <label class="form-check-label" for="js1_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="status-radio">
                <h4>Status</h4>
                <div class="form-check">
                    <input class="form-check-input js1_statusRadio" type="radio" value="Total" name="js1_statusRadio" id="js1_total" checked>
                    <label class="form-check-label" for="js1_total">
                        Total Employment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_statusRadio" type="radio" value="FT" name="js1_statusRadio" id="js1_fullTime">
                    <label class="form-check-label" for="js1_fullTime">
                        Full Time (%)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_statusRadio" type="radio" value="PT" name="js1_statusRadio" id="js1_partTime">
                    <label class="form-check-label" for="js1_partTime">
                        Part Time (%)
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input js1_pageRadio js_page0" type="radio" value="0" name="js1_pageRadio" id="js1_0">
                    <label class="form-check-label" for="js1_0">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_pageRadio js_page1" type="radio" value="1" name="js1_pageRadio" id="js1_1" checked>
                    <label class="form-check-label" for="js1_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js1_pageRadio js_page2" type="radio" value="2" name="js1_pageRadio" id="js1_2">
                    <label class="form-check-label" for="js1_2">
                        Show all years
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="js2_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="js2_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="status-radio">
                <h4>Status</h4>
                <div class="form-check">
                    <input class="form-check-input js2_statusRadio" type="radio" value="Total" name="js2_statusRadio" id="js2_total" checked>
                    <label class="form-check-label" for="js2_total">
                        Total Employment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_statusRadio" type="radio" value="FT" name="js2_statusRadio" id="js2_fullTime">
                    <label class="form-check-label" for="js2_fullTime">
                        Full Time (%)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_statusRadio" type="radio" value="PT" name="js2_statusRadio" id="js2_partTime">
                    <label class="form-check-label" for="js2_partTime">
                        Part Time (%)
                    </label>
                </div>
            </div>
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input js2_sectorRadio" type="radio" value="Tourism" name="js2_sectorRadio" id="js2_tourism" checked>
                    <label class="form-check-label" for="js2_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_sectorRadio" type="radio" value="Accommodation" name="js2_sectorRadio" id="js2_accommodation">
                    <label class="form-check-label" for="js2_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_sectorRadio" type="radio" value="FoodBeverage" name="js2_sectorRadio" id="js2_food">
                    <label class="form-check-label" for="js2_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_sectorRadio" type="radio" value="RecreationEnter" name="js2_sectorRadio" id="js2_rec">
                    <label class="form-check-label" for="js2_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_sectorRadio" type="radio" value="Transportation & Travel" name="js2_sectorRadio" id="js2_transportation">
                    <label class="form-check-label" for="js2_transportation">
                    Transportation and Travel
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input js2_pageRadio js_page0" type="radio" value="0" name="js2_pageRadio" id="js2_0">
                    <label class="form-check-label" for="js2_0">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_pageRadio js_page1" type="radio" value="1" name="js2_pageRadio" id="js2_1" >
                    <label class="form-check-label" for="js2_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input js2_pageRadio js_page2" type="radio" value="2" name="js2_pageRadio" id="js2_2" checked>
                    <label class="form-check-label" for="js2_2">
                        Show all years
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="js-table"></table>
    </div>    
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-6_job_status_2019-2023.csv" download="bc_tourism_job_status_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <!--- CHART 7 --->
    <a id="7"></a>
    <div class="ChartBox">
    <h2>Chart 7: Labour Force by Sector, 2019-2023</h2>
    <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>The Tourism and Hospitality labour force includes all the people working in the Tourism and Hospitality sector as well as unemployed individuals seeking work whose last job was in the Tourism and Hospitality sector. The total number of people in the Tourism and Hospitality labor force shows how many individuals are available to work in the sector. Reductions in the labor force can be due to workers moving to different industries for work, declines in available employment opportunities, or because unemployed workers decide not to continue looking for work in the sector.</li>
                <li>The Tourism and Hospitality labour force decreased 5.4% in September 2023 to 362,500 as compared to August 2023 at 383,000. Labour force losses were observed in all Tourism and Hospitality sectors except the Recreation and Entertainment sector.</li>
                <li>Data suggests that the overall industry labour force has surpassed its pre-COVID level (362,500 in September 2023 vs 354,500 in September 2019).</li>
            </ul>
        </div>  
    </div>
    
    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 7 tracks the labour force in each of the Tourism and Hospitality sectors in BC This chart has three display options, which can be toggled in the lower right-hand corner of the chart. The first option displays the total monthly labour force for a selected sector for the last three years since 2019. The second option shows the total monthly labour force broken down into employed and unemployed workers for a selected year and sector. The third option displays the total monthly labour force for any number of sectors in a given year.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly industry sector data at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    
    <div class="row chart-and-controls" id="lf0_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="lf0_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input lf0_sectorRadio" type="radio" value="Tourism" name="lf0_sectorRadio" id="lf0_tourism" checked>
                    <label class="form-check-label" for="lf0_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0_sectorRadio" type="radio" value="Accommodation" name="lf0_sectorRadio" id="lf0_accommodation">
                    <label class="form-check-label" for="lf0_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0_sectorRadio" type="radio" value="FoodBeverage" name="lf0_sectorRadio" id="lf0_food">
                    <label class="form-check-label" for="lf0_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0_sectorRadio" type="radio" value="RecreationEnter" name="lf0_sectorRadio" id="lf0_rec">
                    <label class="form-check-label" for="lf0_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0_sectorRadio" type="radio" value="Transportation & Travel" name="lf0_sectorRadio" id="lf0_transportation">
                    <label class="form-check-label" for="lf0_transportation">
                    Transportation and Travel
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input lf0_pageRadio lf_page0" type="radio" value="0" name="lf0_pageRadio" id="lf0_0" checked>
                    <label class="form-check-label" for="lf0_0">
                        Show all years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0_pageRadio lf_page1" type="radio" value="1" name="lf0_pageRadio" id="lf0_1">
                    <label class="form-check-label" for="lf0_1">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0_pageRadio lf_page2" type="radio" value="2" name="lf0_pageRadio" id="lf0_2">
                    <label class="form-check-label" for="lf0_2">
                        Show all sectors
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="lf1_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="lf1_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input lf1_yearRadio" type="radio" value="2019" name="lf1_yearRadio" id="lf1_2019">
                    <label class="form-check-label" for="lf1_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_yearRadio" type="radio" value="2020" name="lf1_yearRadio" id="lf1_2020">
                    <label class="form-check-label" for="lf1_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_yearRadio" type="radio" value="2021" name="lf1_yearRadio" id="lf1_2021">
                    <label class="form-check-label" for="lf1_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_yearRadio" type="radio" value="2022" name="lf1_yearRadio" id="lf1_2022">
                    <label class="form-check-label" for="lf1_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_yearRadio" type="radio" value="2023" name="lf1_yearRadio" id="lf1_2023" checked>
                    <label class="form-check-label" for="lf1_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input lf1_sectorRadio" type="radio" value="Tourism" name="lf1_sectorRadio" id="lf1_tourism" checked>
                    <label class="form-check-label" for="lf1_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_sectorRadio" type="radio" value="Accommodation" name="lf1_sectorRadio" id="lf1_accommodation">
                    <label class="form-check-label" for="lf1_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_sectorRadio" type="radio" value="FoodBeverage" name="lf1_sectorRadio" id="lf1_food">
                    <label class="form-check-label" for="lf1_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_sectorRadio" type="radio" value="RecreationEnter" name="lf1_sectorRadio" id="lf1_rec">
                    <label class="form-check-label" for="lf1_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_sectorRadio" type="radio" value="Transportation & Travel" name="lf1_sectorRadio" id="lf1_transportation">
                    <label class="form-check-label" for="lf1_transportation">
                        Transportation and Travel
                    </label>
                </div>
            </div>
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input lf1_pageRadio lf_page0" type="radio" value="0" name="lf1_pageRadio" id="lf1_0">
                    <label class="form-check-label" for="lf1_0">
                        Show all years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_pageRadio lf_page1" type="radio" value="1" name="lf1_pageRadio" id="lf1_1" checked>
                    <label class="form-check-label" for="lf1_1">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1_pageRadio lf_page2" type="radio" value="2" name="lf1_pageRadio" id="lf1_2">
                    <label class="form-check-label" for="lf1_2">
                        Show all sectors
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="lf2_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="lf2_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input lf2_yearRadio" type="radio" value="2019" name="lf2_yearRadio" id="lf2_2019">
                    <label class="form-check-label" for="lf2_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_yearRadio" type="radio" value="2020" name="lf2_yearRadio" id="lf2_2020">
                    <label class="form-check-label" for="lf2_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_yearRadio" type="radio" value="2021" name="lf2_yearRadio" id="lf2_2021">
                    <label class="form-check-label" for="lf2_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_yearRadio" type="radio" value="2022" name="lf2_yearRadio" id="lf2_2022">
                    <label class="form-check-label" for="lf2_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_yearRadio" type="radio" value="2023" name="lf2_yearRadio" id="lf2_2023" checked>
                    <label class="form-check-label" for="lf2_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input lf2_sectorCheck" type="checkbox" value="Tourism" name="lf2_sectorCheck" id="lf2_tourismCheck" checked>
                    <label class="form-check-label" for="lf2_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_sectorCheck" type="checkbox" value="Accommodation" name="lf2_sectorCheck" id="lf2_accommodationCheck" checked>
                    <label class="form-check-label" for="lf2_accommodationCheck">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_sectorCheck" type="checkbox" value="FoodBeverage" name="lf2_sectorCheck" id="lf2_foodBeverageCheck" checked>
                    <label class="form-check-label" for="lf2_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_sectorCheck" type="checkbox" value="RecreationEnter" name="lf2_sectorCheck" id="lf2_recreationCheck" checked>
                    <label class="form-check-label" for="lf2_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_sectorCheck" type="checkbox" value="Transportation & Travel" name="lf2_sectorCheck" id="lf2_transportationCheck" checked>
                    <label class="form-check-label" for="lf2_transportationCheck">
                    Transportation and Travel
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input lf2_pageRadio lf_page0" type="radio" value="0" name="lf2_pageRadio" id="lf2_0">
                    <label class="form-check-label" for="lf2_0">
                        Show all years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_pageRadio lf_page1" type="radio" value="1" name="lf2_pageRadio" id="lf2_1" >
                    <label class="form-check-label" for="lf2_1">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2_pageRadio lf_page2" type="radio" value="2" name="lf2_pageRadio" id="lf2_2" checked>
                    <label class="form-check-label" for="lf2_2">
                        Show all sectors
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="lf-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-7_labour_force_by_sector_2019-2023.csv" download="bc_tourism_labour_force_by_sector_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="8"></a>
    <div class="ChartBox">
    <h2>Chart 8: Labour Force by Region, 2019-2023</h2>
    <div class="key-takeaways">
       <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>The Tourism and Hospitality labor force includes people working in the Tourism and Hospitality sector as well as unemployed individuals seeking work whose last job was in the Tourism and Hospitality sector. The total number of people in the Tourism and Hospitality labour force shows how many individuals are available to work in the sector. Reductions in the labor force can be due to workers moving to different industries for work, declines in available employment opportunities, or because unemployed workers decide not to continue looking for work in the sector.</li>
                <li>The Tourism and Hospitality labour force decreased by 5.4% in September 2023 to 362,500 as compared to August 2023 at 383,000. Labour force losses were observed in all regions except the Kootenay and Northern BC regions. </li>
                <li>Data suggests that the overall industry labour force has surpassed its pre-COVID level (362,500 in September 2023 vs 354,500 in September 2019).</li>
            </ul>
        </div>  
    </div>

    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 8 tracks the labour force in each of the economic development regions in BC This chart has three display options, which can be toggled in the lower right-hand corner of the chart. The first option displays the total monthly labour force for a selected region for the last three years since 2019. The second option shows the total monthly labour force broken down into employed and unemployed workers for a selected year and region. The third option displays the total monthly labour force for any number of regions in a given year.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly industry sector data at the regional level, typically higher than the variability at the provincial level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>. Regional data on unemployment with counts below 10,000 must be used with high caution.</p></div>
    </div>
    
    
    <div class="row chart-and-controls" id="lf0b_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="lf0b_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="region-radio">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="BC" name="lf0b_regionRadio" id="lf0b_bc" checked>
                    <label class="form-check-label" for="lf0b_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="Cariboo" name="lf0b_regionRadio" id="lf0b_cariboo" >
                    <label class="form-check-label" for="lf0b_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="LowerMain" name="lf0b_regionRadio" id="lf0b_lowerMainland" >
                    <label class="form-check-label" for="lf0b_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="Northern BC" name="lf0b_regionRadio" id="lf0b_northernBC" >
                    <label class="form-check-label" for="lf0b_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="ThompOkan" name="lf0b_regionRadio" id="lf0b_thompOkan" >
                    <label class="form-check-label" for="lf0b_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="Kootenay" name="lf0b_regionRadio" id="lf0b_kootenay" >
                    <label class="form-check-label" for="lf0b_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_regionRadio" type="radio" value="VanIsdCos" name="lf0b_regionRadio" id="lf0b_vanIsdCos" >
                    <label class="form-check-label" for="lf0b_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input lf0b_pageRadio lfb_page0" type="radio" value="0" name="lf0b_pageRadio" id="lf0b_0" checked>
                    <label class="form-check-label" for="lf0b_0">
                        Show all years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_pageRadio lfb_page1" type="radio" value="1" name="lf0b_pageRadio" id="lf0b_1">
                    <label class="form-check-label" for="lf0b_1">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf0b_pageRadio lfb_page2" type="radio" value="2" name="lf0b_pageRadio" id="lf0b_2">
                    <label class="form-check-label" for="lf0b_2">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="lf1b_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="lf1b_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input lf1b_yearRadio" type="radio" value="2019" name="lf1b_yearRadio" id="lf1b_2019">
                    <label class="form-check-label" for="lf1b_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_yearRadio" type="radio" value="2020" name="lf1b_yearRadio" id="lf1b_2020">
                    <label class="form-check-label" for="lf1b_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_yearRadio" type="radio" value="2021" name="lf1b_yearRadio" id="lf1b_2021">
                    <label class="form-check-label" for="lf1b_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_yearRadio" type="radio" value="2022" name="lf1b_yearRadio" id="lf1b_2022">
                    <label class="form-check-label" for="lf1b_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_yearRadio" type="radio" value="2023" name="lf1b_yearRadio" id="lf1b_2023" checked>
                    <label class="form-check-label" for="lf1b_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="region-radio">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="BC" name="lf1b_regionRadio" id="lf1b_bc" checked>
                    <label class="form-check-label" for="lf1b_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="Cariboo" name="lf1b_regionRadio" id="lf1b_cariboo" >
                    <label class="form-check-label" for="lf1b_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="LowerMain" name="lf1b_regionRadio" id="lf1b_lowerMainland" >
                    <label class="form-check-label" for="lf1b_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="Northern BC" name="lf1b_regionRadio" id="lf1b_northernBC" >
                    <label class="form-check-label" for="lf1b_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="ThompOkan" name="lf1b_regionRadio" id="lf1b_thompOkan" >
                    <label class="form-check-label" for="lf1b_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="Kootenay" name="lf1b_regionRadio" id="lf1b_kootenay" >
                    <label class="form-check-label" for="lf1b_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_regionRadio" type="radio" value="VanIsdCos" name="lf1b_regionRadio" id="lf1b_vanIsdCos" >
                    <label class="form-check-label" for="lf1b_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input lf1b_pageRadio lfb_page0" type="radio" value="0" name="lf1b_pageRadio" id="lf1b_0">
                    <label class="form-check-label" for="lf1b_0">
                        Show all years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_pageRadio lfb_page1" type="radio" value="1" name="lf1b_pageRadio" id="lf1b_1" checked>
                    <label class="form-check-label" for="lf1b_1">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf1b_pageRadio lfb_page2" type="radio" value="2" name="lf1b_pageRadio" id="lf1b_2">
                    <label class="form-check-label" for="lf1b_2">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="lf2b_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="lf2b_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input lf2b_yearRadio" type="radio" value="2019" name="lf2b_yearRadio" id="lf2b_2019">
                    <label class="form-check-label" for="lf2b_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_yearRadio" type="radio" value="2020" name="lf2b_yearRadio" id="lf2b_2020">
                    <label class="form-check-label" for="lf2b_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_yearRadio" type="radio" value="2021" name="lf2b_yearRadio" id="lf2b_2021">
                    <label class="form-check-label" for="lf2b_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_yearRadio" type="radio" value="2022" name="lf2b_yearRadio" id="lf2b_2022">
                    <label class="form-check-label" for="lf2b_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_yearRadio" type="radio" value="2023" name="lf2b_yearRadio" id="lf2b_2023" checked>
                    <label class="form-check-label" for="lf2b_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="region-check">
                <h4>Regions</h4>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="BC" id="lf2b_bcCheck" >
                    <label class="form-check-label" for="lf2b_bcCheck">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="Cariboo" name="lf2b_regionCheck" id="lf2b_caribooCheck" checked>
                    <label class="form-check-label" for="lf2b_caribooCheck">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="LowerMain" name="lf2b_regionCheck" id="lf2b_lowerMainlandCheck" checked>
                    <label class="form-check-label" for="lf2b_lowerMainlandCheck">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="Northern BC" name="lf2b_regionCheck" id="lf2b_northernBCCheck" checked>
                    <label class="form-check-label" for="lf2b_northernBCCheck">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="ThompOkan" name="lf2b_regionCheck" id="lf2b_thompOkanCheck" checked>
                    <label class="form-check-label" for="lf2b_thompOkanCheck">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="Kootenay" name="lf2b_regionCheck" id="lf2b_kootenayCheck" checked>
                    <label class="form-check-label" for="lf2b_kootenayCheck">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_regionCheck" type="checkbox" value="VanIsdCos" name="lf2b_regionCheck" id="lf2b_vanIsdCosCheck" checked>
                    <label class="form-check-label" for="lf2b_vanIsdCosCheck">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                <input class="form-check-input lf2b_pageRadio lfb_page0" type="radio" value="0" name="lf2b_pageRadio" id="lf2b_0">
                    <label class="form-check-label" for="lf2b_0">
                        Show all years
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_pageRadio lfb_page1" type="radio" value="1" name="lf2b_pageRadio" id="lf2b_1" >
                    <label class="form-check-label" for="lf2b_1">
                        Show all statuses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input lf2b_pageRadio lfb_page2" type="radio" value="2" name="lf2b_pageRadio" id="lf2b_2" checked>
                    <label class="form-check-label" for="lf2b_2">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="lfb-table"></table>
    </div>
    
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-8_labour_force_by_region_2019-2023.csv" download="bc_tourism_labour_force_by_region_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <!-- Chart 9  Unemployment-->
    <a id="9"></a>
    <div class="ChartBox">
    <h2>Chart 9: Unemployment Rate, 2019-2023</h2>
    <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>The unemployment rate in the Tourism and Hospitality sector in BC slightly decreased from 4.0% in August 2023 to 3.7% in September 2023. The unemployment rate fell below the pre-covid level (5.0% in September 2019 vs 3.7% in September 2023). The quoted unemployment rate is also lower in comparison to the same month in 2020 and 2021.</li>
                <li>In September 2023, the unemployment rate ranged between 0.4% and 8.7% across the four Tourism and Hospitality sectors. The Recreation and Entertainment sector has a relatively higher unemployment rate.</li>
                <li>The unemployment rate in September 2023 ranged from 2.6% to 6.6% across the six economic development regions in BC. The Thompson Okanagan region had the highest unemployment rate at 6.6%. </li>
            </ul>
        </div>  
    </div>
    
    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 9 tracks the unemployment rate of the Tourism and Hospitality sector in BC This chart has four display options, which can be toggled in the lower right-hand corner of the chart. The first two options allow users to group data by sector and the last two options allow users to group data by region. The first and third option, labeled "filter by", will display the monthly unemployment rate for a selected sector or region over the past three years since 2019. The second and fourth options, labeled "show all", will display the unemployment rate for any number of sectors or regions for one selected year.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <p>Readers should note that Canadians are considered unemployed if they are actively seeking work. The number of individuals employed in BC’s Tourism and Hospitality sector has decreased by 70,000 from February 2020 to date, but the number of “unemployed” individuals increased by only 4,000, which shows that unemployed individuals have decided that actively seeking work is either not beneficial, or they are waiting for businesses to re-open before continuing to look for work. The abruptness of the job losses resulting from the COVID-19 pandemic and the attached restrictions has created a unique labor market and therefore the unemployment rate can only tell part of the story. When restrictions are lifted, businesses are able to re-open, and emergency benefits are drawn back, the unemployment rate will become a more accurate indicator of the relative strength of the labour market.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly demographic data at the provincial level and regional level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    
    <div class="row chart-and-controls" id="ur0_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ur0_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input ur0_sectorRadio" type="radio" value="Tourism" name="ur0_sectorRadio" id="ur0_tourism" checked>
                    <label class="form-check-label" for="ur0_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_sectorRadio" type="radio" value="Accommodation" name="ur0_sectorRadio" id="ur0_accommodation">
                    <label class="form-check-label" for="ur0_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_sectorRadio" type="radio" value="FoodBeverage" name="ur0_sectorRadio" id="ur0_food">
                    <label class="form-check-label" for="ur0_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_sectorRadio" type="radio" value="RecreationEnter" name="ur0_sectorRadio" id="ur0_rec">
                    <label class="form-check-label" for="ur0_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_sectorRadio" type="radio" value="Transportation & Travel" name="ur0_sectorRadio" id="ur0_transportation">
                    <label class="form-check-label" for="ur0_transportation">
                    Transportation & Travel
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input ur0_pageRadio ur_page0" type="radio" value="0" name="ur0_pageRadio" id="ur0_0" checked>
                    <label class="form-check-label" for="ur0_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_pageRadio ur_page1" type="radio" value="1" name="ur0_pageRadio" id="ur0_1">
                    <label class="form-check-label" for="ur0_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_pageRadio ur_page2" type="radio" value="2" name="ur0_pageRadio" id="ur0_2">
                    <label class="form-check-label" for="ur0_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur0_pageRadio ur_page3" type="radio" value="3" name="ur0_pageRadio" id="ur0_3">
                    <label class="form-check-label" for="ur0_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="ur1_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ur1_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input ur1_yearRadio" type="radio" value="2019" name="ur1_yearRadio" id="ur1_2019">
                    <label class="form-check-label" for="ur1_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_yearRadio" type="radio" value="2020" name="ur1_yearRadio" id="ur1_2020">
                    <label class="form-check-label" for="ur1_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_yearRadio" type="radio" value="2021" name="ur1_yearRadio" id="ur1_2021">
                    <label class="form-check-label" for="ur1_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_yearRadio" type="radio" value="2022" name="ur1_yearRadio" id="ur1_2022">
                    <label class="form-check-label" for="ur1_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_yearRadio" type="radio" value="2023" name="ur1_yearRadio" id="ur1_2023" checked>
                    <label class="form-check-label" for="ur1_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="sector-check">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input ur1_sectorCheck" type="checkbox" value="Tourism" name="ur1_sectorCheck" id="ur1_tourismCheck" checked>
                    <label class="form-check-label" for="ur1_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_sectorCheck" type="checkbox" value="Accommodation" name="ur1_sectorCheck" id="ur1_accommodationCheck" checked>
                    <label class="form-check-label" for="ur1_accommodationCheck">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_sectorCheck" type="checkbox" value="FoodBeverage" name="ur1_sectorCheck" id="ur1_foodBeverageCheck" checked>
                    <label class="form-check-label" for="ur1_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_sectorCheck" type="checkbox" value="RecreationEnter" name="ur1_sectorCheck" id="ur1_recreationCheck" checked>
                    <label class="form-check-label" for="ur1_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_sectorCheck" type="checkbox" value="Transportation & Travel" name="ur1_sectorCheck" id="ur1_transportationCheck" checked>
                    <label class="form-check-label" for="ur1_transportationCheck">
                        Transportation & Travel
                    </label>
                </div>
            </div>
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input ur1_pageRadio ur_page0" type="radio" value="0" name="ur1_pageRadio" id="ur1_0" checked>
                    <label class="form-check-label" for="ur1_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_pageRadio ur_page1" type="radio" value="1" name="ur1_pageRadio" id="ur1_1">
                    <label class="form-check-label" for="ur1_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_pageRadio ur_page2" type="radio" value="2" name="ur1_pageRadio" id="ur1_2">
                    <label class="form-check-label" for="ur1_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur1_pageRadio ur_page3" type="radio" value="3" name="ur1_pageRadio" id="ur1_3">
                    <label class="form-check-label" for="ur1_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="ur2_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ur2_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="region-radio">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="BC" name="ur2_regionRadio" id="ur2_bc" checked>
                    <label class="form-check-label" for="ur2_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="Cariboo" name="ur2_regionRadio" id="ur2_cariboo" >
                    <label class="form-check-label" for="ur2_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="LowerMain" name="ur2_regionRadio" id="ur2_lowerMainland" >
                    <label class="form-check-label" for="ur2_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="Northern BC" name="ur2_regionRadio" id="ur2_northernBC" >
                    <label class="form-check-label" for="ur2_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="ThompOkan" name="ur2_regionRadio" id="ur2_thompOkan" >
                    <label class="form-check-label" for="ur2_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="Kootenay" name="ur2_regionRadio" id="ur2_kootenay" >
                    <label class="form-check-label" for="ur2_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_regionRadio" type="radio" value="VanIsdCos" name="ur2_regionRadio" id="ur2_vanIsdCos" >
                    <label class="form-check-label" for="ur2_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input ur2_pageRadio ur_page0" type="radio" value="0" name="ur2_pageRadio" id="ur2_0" checked>
                    <label class="form-check-label" for="ur2_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_pageRadio ur_page1" type="radio" value="1" name="ur2_pageRadio" id="ur2_1">
                    <label class="form-check-label" for="ur2_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_pageRadio ur_page2" type="radio" value="2" name="ur2_pageRadio" id="ur2_2">
                    <label class="form-check-label" for="ur2_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur2_pageRadio ur_page3" type="radio" value="3" name="ur2_pageRadio" id="ur2_3">
                    <label class="form-check-label" for="ur2_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="ur3_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ur3_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input ur3_yearRadio" type="radio" value="2019" name="ur3_yearRadio" id="ur3_2019">
                    <label class="form-check-label" for="ur3_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_yearRadio" type="radio" value="2020" name="ur3_yearRadio" id="ur3_2020">
                    <label class="form-check-label" for="ur3_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_yearRadio" type="radio" value="2021" name="ur3_yearRadio" id="ur3_2021" checked>
                    <label class="form-check-label" for="ur3_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_yearRadio" type="radio" value="2022" name="ur3_yearRadio" id="ur3_2022">
                    <label class="form-check-label" for="ur3_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_yearRadio" type="radio" value="2023" name="ur3_yearRadio" id="ur3_2023">
                    <label class="form-check-label" for="ur3_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="region-check">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="BC" name="ur3_regionCheck" id="ur3_bc" >
                    <label class="form-check-label" for="ur3_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="Cariboo" name="ur3_regionCheck" id="ur3_cariboo" checked>
                    <label class="form-check-label" for="ur3_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="LowerMain" name="ur3_regionCheck" id="ur3_lowerMainland" checked>
                    <label class="form-check-label" for="ur3_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="Northern BC" name="ur3_regionCheck" id="ur3_northernBC" checked>
                    <label class="form-check-label" for="ur3_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="ThompOkan" name="ur3_regionCheck" id="ur3_thompOkan" checked>
                    <label class="form-check-label" for="ur3_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="Kootenay" name="ur3_regionCheck" id="ur3_kootenay" checked>
                    <label class="form-check-label" for="ur3_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_regionCheck" type="checkbox" value="VanIsdCos" name="ur3_regionCheck" id="ur3_vanIsdCos" checked>
                    <label class="form-check-label" for="ur3_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input ur3_pageRadio ur_page0" type="radio" value="0" name="ur3_pageRadio" id="ur3_0" checked>
                    <label class="form-check-label" for="ur3_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_pageRadio ur_page1" type="radio" value="1" name="ur3_pageRadio" id="ur3_1">
                    <label class="form-check-label" for="ur3_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_pageRadio ur_page2" type="radio" value="2" name="ur3_pageRadio" id="ur3_2">
                    <label class="form-check-label" for="ur3_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ur3_pageRadio ur_page3" type="radio" value="3" name="ur3_pageRadio" id="ur3_3">
                    <label class="form-check-label" for="ur3_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="ur-table"></table>
    </div>    
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-9_unemployment_2019-2023.csv" download="bc_tourism_unemployment_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

      <!-- Chart 10  Hours Worked-->
      <a id="10"></a>
    <div class="ChartBox">
      <h2>Chart 10: Actual Hours Worked Per Week, 2019-2023</h2>
      <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>Aggregate weekly hours worked in BC’s Tourism and Hospitality sector decreased from 11.0 million hours per week in August 2023 to 9.8 million hours per week in September 2023. The magnitude of the decrease is much more significant in the Accommodation sector. In terms of regions, the Lower Mainland region had the largest decrease.</li>
                <li>The overall actual hours worked per week were low in comparison to the pre-COVID levels (10.4 million hours worked per week in September 2019 vs 9.8 million in September 2023).</li>
            </ul>
        </div>  
    </div>
    
    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 10 tracks the hours worked in one week in the Tourism and Hospitality sector in B.C each month. This chart has four display options, which can be toggled in the lower right-hand corner of the chart. The first two options allow users to group data by sector and the last two options allow users to group data by region. The first and third option, labeled "filter by", will display the monthly hours worked for one selected sector or region over the past three years since 2019. The second and fourth options, labeled "show all", will display the hours worked for any number of sectors or regions for one selected year.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly demographic data at the provincial level and regional level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    
      <div class="row chart-and-controls" id="hw0_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hw0_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input hw0_sectorRadio" type="radio" value="Tourism" name="hw0_sectorRadio" id="hw0_tourism" checked>
                    <label class="form-check-label" for="hw0_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_sectorRadio" type="radio" value="Accommodation" name="hw0_sectorRadio" id="hw0_accommodation">
                    <label class="form-check-label" for="hw0_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_sectorRadio" type="radio" value="FoodBeverage" name="hw0_sectorRadio" id="hw0_food">
                    <label class="form-check-label" for="hw0_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_sectorRadio" type="radio" value="RecreationEnter" name="hw0_sectorRadio" id="hw0_rec">
                    <label class="form-check-label" for="hw0_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_sectorRadio" type="radio" value="Transportation" name="hw0_sectorRadio" id="hw0_transportation">
                    <label class="form-check-label" for="hw0_transportation">
                    Transportation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_sectorRadio" type="radio" value="Travel Services" name="hw0_sectorRadio" id="hw0_travel">
                    <label class="form-check-label" for="hw0_travel">
                    Travel Services
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hw0_pageRadio hw_page0" type="radio" value="0" name="hw0_pageRadio" id="hw0_0" checked>
                    <label class="form-check-label" for="hw0_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_pageRadio hw_page1" type="radio" value="1" name="hw0_pageRadio" id="hw0_1">
                    <label class="form-check-label" for="hw0_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_pageRadio hw_page2" type="radio" value="2" name="hw0_pageRadio" id="hw0_2">
                    <label class="form-check-label" for="hw0_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw0_pageRadio hw_page3" type="radio" value="3" name="hw0_pageRadio" id="hw0_3">
                    <label class="form-check-label" for="hw0_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="hw1_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hw1_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input hw1_yearRadio" type="radio" value="2019" name="hw1_yearRadio" id="hw1_2019">
                    <label class="form-check-label" for="hw1_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_yearRadio" type="radio" value="2020" name="hw1_yearRadio" id="hw1_2020">
                    <label class="form-check-label" for="hw1_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_yearRadio" type="radio" value="2021" name="hw1_yearRadio" id="hw1_2021">
                    <label class="form-check-label" for="hw1_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_yearRadio" type="radio" value="2022" name="hw1_yearRadio" id="hw1_2022">
                    <label class="form-check-label" for="hw1_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_yearRadio" type="radio" value="2023" name="hw1_yearRadio" id="hw1_2023" checked>
                    <label class="form-check-label" for="hw1_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="sector-check">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input hw1_sectorCheck" type="checkbox" value="Tourism" name="hw1_sectorCheck" id="hw1_tourismCheck">
                    <label class="form-check-label" for="hw1_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_sectorCheck" type="checkbox" value="Accommodation" name="hw1_sectorCheck" id="hw1_accommodationCheck" checked>
                    <label class="form-check-label" for="hw1_accommodationCheck">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_sectorCheck" type="checkbox" value="FoodBeverage" name="hw1_sectorCheck" id="hw1_foodBeverageCheck" checked>
                    <label class="form-check-label" for="hw1_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_sectorCheck" type="checkbox" value="RecreationEnter" name="hw1_sectorCheck" id="hw1_recreationCheck" checked>
                    <label class="form-check-label" for="hw1_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_sectorCheck" type="checkbox" value="Transportation" name="hw1_sectorCheck" id="hw1_transportationCheck" checked>
                    <label class="form-check-label" for="hw1_transportationCheck">
                        Transportation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_sectorCheck" type="checkbox" value="Travel Services" name="hw1_sectorCheck" id="hw1_travelCheck" checked>
                    <label class="form-check-label" for="hw1_travelCheck">
                        Travel
                    </label>
                </div>
            </div>
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hw1_pageRadio hw_page0" type="radio" value="0" name="hw1_pageRadio" id="hw1_0" checked>
                    <label class="form-check-label" for="hw1_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_pageRadio hw_page1" type="radio" value="1" name="hw1_pageRadio" id="hw1_1">
                    <label class="form-check-label" for="hw1_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_pageRadio hw_page2" type="radio" value="2" name="hw1_pageRadio" id="hw1_2">
                    <label class="form-check-label" for="hw1_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw1_pageRadio hw_page3" type="radio" value="3" name="hw1_pageRadio" id="hw1_3">
                    <label class="form-check-label" for="hw1_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="hw2_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hw2_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="region-radio">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="BC" name="hw2_regionRadio" id="hw2_bc" checked>
                    <label class="form-check-label" for="hw2_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="Cariboo" name="hw2_regionRadio" id="hw2_cariboo" >
                    <label class="form-check-label" for="hw2_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="LowerMain" name="hw2_regionRadio" id="hw2_lowerMainland" >
                    <label class="form-check-label" for="hw2_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="Northern BC" name="hw2_regionRadio" id="hw2_northernBC" >
                    <label class="form-check-label" for="hw2_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="ThompOkan" name="hw2_regionRadio" id="hw2_thompOkan" >
                    <label class="form-check-label" for="hw2_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="Kootenay" name="hw2_regionRadio" id="hw2_kootenay" >
                    <label class="form-check-label" for="hw2_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_regionRadio" type="radio" value="VanIsdCos" name="hw2_regionRadio" id="hw2_vanIsdCos" >
                    <label class="form-check-label" for="hw2_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hw2_pageRadio hw_page0" type="radio" value="0" name="hw2_pageRadio" id="hw2_0" checked>
                    <label class="form-check-label" for="hw2_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_pageRadio hw_page1" type="radio" value="1" name="hw2_pageRadio" id="hw2_1">
                    <label class="form-check-label" for="hw2_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_pageRadio hw_page2" type="radio" value="2" name="hw2_pageRadio" id="hw2_2">
                    <label class="form-check-label" for="hw2_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw2_pageRadio hw_page3" type="radio" value="3" name="hw2_pageRadio" id="hw2_3">
                    <label class="form-check-label" for="hw2_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="hw3_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hw3_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input hw3_yearRadio" type="radio" value="2019" name="hw3_yearRadio" id="hw3_2019">
                    <label class="form-check-label" for="hw3_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_yearRadio" type="radio" value="2020" name="hw3_yearRadio" id="hw3_2020">
                    <label class="form-check-label" for="hw3_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_yearRadio" type="radio" value="2021" name="hw3_yearRadio" id="hw3_2021" checked>
                    <label class="form-check-label" for="hw3_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_yearRadio" type="radio" value="2022" name="hw3_yearRadio" id="hw3_2022">
                    <label class="form-check-label" for="hw3_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_yearRadio" type="radio" value="2023" name="hw3_yearRadio" id="hw3_2023">
                    <label class="form-check-label" for="hw3_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="region-check">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="BC" name="hw3_regionCheck" id="hw3_bc" >
                    <label class="form-check-label" for="hw3_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="Cariboo" name="hw3_regionCheck" id="hw3_cariboo" checked>
                    <label class="form-check-label" for="hw3_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="LowerMain" name="hw3_regionCheck" id="hw3_lowerMainland" checked>
                    <label class="form-check-label" for="hw3_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="Northern BC" name="hw3_regionCheck" id="hw3_northernBC" checked>
                    <label class="form-check-label" for="hw3_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="ThompOkan" name="hw3_regionCheck" id="hw3_thompOkan" checked>
                    <label class="form-check-label" for="hw3_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="Kootenay" name="hw3_regionCheck" id="hw3_kootenay" checked>
                    <label class="form-check-label" for="hw3_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_regionCheck" type="checkbox" value="VanIsdCos" name="hw3_regionCheck" id="hw3_vanIsdCos" checked>
                    <label class="form-check-label" for="hw3_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hw3_pageRadio hw_page0" type="radio" value="0" name="hw3_pageRadio" id="hw3_0" checked>
                    <label class="form-check-label" for="hw3_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_pageRadio hw_page1" type="radio" value="1" name="hw3_pageRadio" id="hw3_1">
                    <label class="form-check-label" for="hw3_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_pageRadio hw_page2" type="radio" value="2" name="hw3_pageRadio" id="hw3_2">
                    <label class="form-check-label" for="hw3_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hw3_pageRadio hw_page3" type="radio" value="3" name="hw3_pageRadio" id="hw3_3">
                    <label class="form-check-label" for="hw3_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="hw-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-10_hours_worked_2019-2023.csv" download="bc_tourism_hours_worked_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <!-- Chart 10  Hourly Rate-->
    <a id="11"></a>
    <div class="ChartBox">
    <h2>Chart 11: Average Hourly Earnings, 2019-2023</h2>
      <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>Average hourly earnings in BC’s Tourism and Hospitality sector have been steady with some fluctuation between $22 to $28 over the past two years. Average hourly earnings by sector ranged from $21 to $41; the Transportation sector had the highest average hourly earnings while the Food and Beverage sector reported the lowest.</li>
                <li>Average hourly earnings by region ranged from $22 to $29 in September 2023; the Lower Mainland region reported the highest average hourly earnings, while the Thompson Okanagan region reported the lowest.</li>
            </ul>
        </div>  
    </div>
    
    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 11 tracks the average hourly wage in the Tourism and Hospitality sector in B.C each month. This chart has four display options, which can be toggled in the lower right-hand corner of the chart. The first two options allow users to group data by sector and the last two options allow users to group data by region. The first and third option, labeled "filter by", will display the hourly wage for one selected sector or region over the past three years since 2019. The second and fourth options, labeled "show all", will display the hourly wage for any number of sectors or regions for one selected year.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
        <div class="note"><p><i class="fas fa-bolt"></i><b>Please note:</b> There is high variability in monthly demographic data at the provincial level and regional level. Coefficient of Variation for BC estimates can be found <a onclick="showVariationTable()" style="text-decoration: underline;">here</a>.</p></div>
    </div>
    
    
    <div class="row chart-and-controls" id="hr0_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hr0_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="sector-radio">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input hr0_sectorRadio" type="radio" value="Tourism" name="hr0_sectorRadio" id="hr0_tourism" checked>
                    <label class="form-check-label" for="hr0_tourism">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_sectorRadio" type="radio" value="Accommodation" name="hr0_sectorRadio" id="hr0_accommodation">
                    <label class="form-check-label" for="hr0_accommodation">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_sectorRadio" type="radio" value="FoodBeverage" name="hr0_sectorRadio" id="hr0_food">
                    <label class="form-check-label" for="hr0_food">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_sectorRadio" type="radio" value="RecreationEnter" name="hr0_sectorRadio" id="hr0_rec">
                    <label class="form-check-label" for="hr0_rec">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_sectorRadio" type="radio" value="Transportation" name="hr0_sectorRadio" id="hr0_transportation">
                    <label class="form-check-label" for="hr0_transportation">
                    Transportation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_sectorRadio" type="radio" value="Travel Services" name="hr0_sectorRadio" id="hr0_travel">
                    <label class="form-check-label" for="hr0_travel">
                    Travel Services
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hr0_pageRadio hr_page0" type="radio" value="0" name="hr0_pageRadio" id="hr0_0" checked>
                    <label class="form-check-label" for="hr0_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_pageRadio hr_page1" type="radio" value="1" name="hr0_pageRadio" id="hr0_1">
                    <label class="form-check-label" for="hr0_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_pageRadio hr_page2" type="radio" value="2" name="hr0_pageRadio" id="hr0_2">
                    <label class="form-check-label" for="hr0_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr0_pageRadio hr_page3" type="radio" value="3" name="hr0_pageRadio" id="hr0_3">
                    <label class="form-check-label" for="hr0_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="hr1_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hr1_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input hr1_yearRadio" type="radio" value="2019" name="hr1_yearRadio" id="hr1_2019">
                    <label class="form-check-label" for="hr1_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_yearRadio" type="radio" value="2020" name="hr1_yearRadio" id="hr1_2020">
                    <label class="form-check-label" for="hr1_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_yearRadio" type="radio" value="2021" name="hr1_yearRadio" id="hr1_2021" checked>
                    <label class="form-check-label" for="hr1_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_yearRadio" type="radio" value="2022" name="hr1_yearRadio" id="hr1_2022">
                    <label class="form-check-label" for="hr1_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_yearRadio" type="radio" value="2023" name="hr1_yearRadio" id="hr1_2023">
                    <label class="form-check-label" for="hr1_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="sector-check">
                <h4>Sector</h4>
                <div class="form-check">
                    <input class="form-check-input hr1_sectorCheck" type="checkbox" value="Tourism" name="hr1_sectorCheck" id="hr1_tourismCheck">
                    <label class="form-check-label" for="hr1_tourismCheck">
                        Tourism and Hospitality (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_sectorCheck" type="checkbox" value="Accommodation" name="hr1_sectorCheck" id="hr1_accommodationCheck" checked>
                    <label class="form-check-label" for="hr1_accommodationCheck">
                        Accommodation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_sectorCheck" type="checkbox" value="FoodBeverage" name="hr1_sectorCheck" id="hr1_foodBeverageCheck" checked>
                    <label class="form-check-label" for="hr1_foodBeverageCheck">
                        Food and Beverage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_sectorCheck" type="checkbox" value="RecreationEnter" name="hr1_sectorCheck" id="hr1_recreationCheck" checked>
                    <label class="form-check-label" for="hr1_recreationCheck">
                        Recreation and Entertainment
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_sectorCheck" type="checkbox" value="Transportation" name="hr1_sectorCheck" id="hr1_transportationCheck" checked>
                    <label class="form-check-label" for="hr1_transportationCheck">
                        Transportation
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_sectorCheck" type="checkbox" value="Travel Services" name="hr1_sectorCheck" id="hr1_travelCheck" checked>
                    <label class="form-check-label" for="hr1_travelCheck">
                        Travel
                    </label>
                </div>
            </div>
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hr1_pageRadio hr_page0" type="radio" value="0" name="hr1_pageRadio" id="hr1_0" checked>
                    <label class="form-check-label" for="hr1_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_pageRadio hr_page1" type="radio" value="1" name="hr1_pageRadio" id="hr1_1">
                    <label class="form-check-label" for="hr1_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_pageRadio hr_page2" type="radio" value="2" name="hr1_pageRadio" id="hr1_2">
                    <label class="form-check-label" for="hr1_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr1_pageRadio hr_page3" type="radio" value="3" name="hr1_pageRadio" id="hr1_3">
                    <label class="form-check-label" for="hr1_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="hr2_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hr2_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="region-radio">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="BC" name="hr2_regionRadio" id="hr2_bc" checked>
                    <label class="form-check-label" for="hr2_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="Cariboo" name="hr2_regionRadio" id="hr2_cariboo" >
                    <label class="form-check-label" for="hr2_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="LowerMain" name="hr2_regionRadio" id="hr2_lowerMainland" >
                    <label class="form-check-label" for="hr2_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="Northern BC" name="hr2_regionRadio" id="hr2_northernBC" >
                    <label class="form-check-label" for="hr2_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="ThompOkan" name="hr2_regionRadio" id="hr2_thompOkan" >
                    <label class="form-check-label" for="hr2_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="Kootenay" name="hr2_regionRadio" id="hr2_kootenay" >
                    <label class="form-check-label" for="hr2_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_regionRadio" type="radio" value="VanIsdCos" name="hr2_regionRadio" id="hr2_vanIsdCos" >
                    <label class="form-check-label" for="hr2_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hr2_pageRadio hr_page0" type="radio" value="0" name="hr2_pageRadio" id="hr2_0" checked>
                    <label class="form-check-label" for="hr2_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_pageRadio hr_page1" type="radio" value="1" name="hr2_pageRadio" id="hr2_1">
                    <label class="form-check-label" for="hr2_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_pageRadio hr_page2" type="radio" value="2" name="hr2_pageRadio" id="hr2_2">
                    <label class="form-check-label" for="hr2_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr2_pageRadio hr_page3" type="radio" value="3" name="hr2_pageRadio" id="hr2_3">
                    <label class="form-check-label" for="hr2_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row chart-and-controls" id="hr3_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="hr3_chart"></canvas>
        </div>
        <div id="controls" class="col-lg-3">
            <div class="year-radios">
                <h4>Year</h4>
                <div class="form-check">
                    <input class="form-check-input hr3_yearRadio" type="radio" value="2019" name="hr3_yearRadio" id="hr3_2019">
                    <label class="form-check-label" for="hr3_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_yearRadio" type="radio" value="2020" name="hr3_yearRadio" id="hr3_2020">
                    <label class="form-check-label" for="hr3_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_yearRadio" type="radio" value="2021" name="hr3_yearRadio" id="hr3_2021" checked>
                    <label class="form-check-label" for="hr3_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_yearRadio" type="radio" value="2022" name="hr3_yearRadio" id="hr3_2022">
                    <label class="form-check-label" for="hr3_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_yearRadio" type="radio" value="2023" name="hr3_yearRadio" id="hr3_2023">
                    <label class="form-check-label" for="hr3_2023">
                        2023
                    </label>
                </div>
            </div>
            <div class="region-check">
                <h4>Region</h4>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="BC" name="hr3_regionCheck" id="hr3_bc" >
                    <label class="form-check-label" for="hr3_bc">
                        BC (all)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="Cariboo" name="hr3_regionCheck" id="hr3_cariboo" checked>
                    <label class="form-check-label" for="hr3_cariboo">
                        Cariboo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="LowerMain" name="hr3_regionCheck" id="hr3_lowerMainland" checked>
                    <label class="form-check-label" for="hr3_lowerMainland">
                        Lower Mainland
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="Northern BC" name="hr3_regionCheck" id="hr3_northernBC" checked>
                    <label class="form-check-label" for="hr3_northernBC">
                        Northern BC
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="ThompOkan" name="hr3_regionCheck" id="hr3_thompOkan" checked>
                    <label class="form-check-label" for="hr3_thompOkan">
                    Thompson Okanagan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="Kootenay" name="hr3_regionCheck" id="hr3_kootenay" checked>
                    <label class="form-check-label" for="hr3_kootenay">
                    Kootenay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_regionCheck" type="checkbox" value="VanIsdCos" name="hr3_regionCheck" id="hr3_vanIsdCos" checked>
                    <label class="form-check-label" for="hr3_vanIsdCos">
                        Vancouver Island
                    </label>
                </div>
            </div>
            
            <div class="page-radios">
                <h4>Options</h4>
                <div class="form-check">
                    <input class="form-check-input hr3_pageRadio hr_page0" type="radio" value="0" name="hr3_pageRadio" id="hr3_0" checked>
                    <label class="form-check-label" for="hr3_0">
                        Filter by sector
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_pageRadio hr_page1" type="radio" value="1" name="hr3_pageRadio" id="hr3_1">
                    <label class="form-check-label" for="hr3_1">
                        Show all sectors
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_pageRadio hr_page2" type="radio" value="2" name="hr3_pageRadio" id="hr3_2">
                    <label class="form-check-label" for="hr3_2">
                        Filter by region
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hr3_pageRadio hr_page3" type="radio" value="3" name="hr3_pageRadio" id="hr3_3">
                    <label class="form-check-label" for="hr3_3">
                        Show all regions
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="hr-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-11_hourly_rate_2019-2023.csv" download="bc_tourism_hourly_rate_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

      <!-- Chart 12  Monthly Sales-->
      <a id="12"></a>
    <div class="ChartBox">
      <h2>Chart 12: Sales Revenue of Food Services and Drinking Places, 2019-2023</h2>
      <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>While employment in the Food and Beverage sector decreased by 1.8% from June 2023 to July 2023, sales of food services and drinking places increased by 4.7%.</li>
                <li>Sales revenues of food services and drinking places are much higher than pre-COVID levels ($1,519 million in July 2023 vs $1,202 million in July 2019) and they are also much higher than in the same month in 2020, 2021, and 2022.</li>
            </ul>
        </div>  
    </div>
    
    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 12 displays the monthly sales of food services and drink places in thousands of dollars each month for the last three years since 2019.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing the data used to create the graph.</p>
    </div>
    

      <div class="row chart-and-controls" id="fs_chart-and-controls">
        <div class="col-lg-12">
            <canvas id="fs_chart"></canvas>
            <p><b>Source:</b> Statistics Canada. Table 21-10-0019-01  Monthly survey of food services and drinking places (x 1,000)</p>									
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="fs-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-12_food_drink_sales_2019-2023.csv" download="bc_tourism_food_drink_sales_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
    </div>

    <a id="13"></a></a>
    <div class="ChartBox">
    <h2>Chart 13: Hotel Occupancy Rate, 2019-2023</h2>
    <div class="key-takeaways">
        <div class="row mb-3">
        <div class="col-6">
          <h3>Key Takeaways:</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#contents" class="btn-border">Back to contents<i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
      </div>
        <div class="key-takeaways-body">
            <ul>
                <li>While employment in the Accommodation sector decreased by 25.8% from July to August 2023, hotel occupancy rates in BC also decreased by 0.7 percentage points to 80.5% in August 2023 from 81.2% in July 2023.</li>
                <li>Provincial hotel occupancy rates remained lower than pre-COVID levels (80.5% in August 2023 vs 85.3% in August 2019). </li>
            </ul>
        </div>  
    </div>

    <button type="button" class="collapsible collapsible-info">How to Use & Limitations</button>
    <div class="info-content">
        <p>Chart 13 displays the hotel occupancy rate each month for the last three years since 2019.</p>
        <p>Clicking the View Table button beneath the graph will expand a table displaying the same information as the graph. There is also a Download button, which will download a csv file containing all of the data used to create the graph.</p>
    </div>
    

    <div class="row chart-and-controls" id="ho_chart-and-controls">
        <div class="col-lg-9">
            <canvas id="ho_chart"></canvas>
            <p><b>Source:</b> Tourism Industry Dashboard, Destination BC. URL: <a href="https://www.destinationbc.ca/tourism-industry-dashboard/">https://www.destinationbc.ca/tourism-industry-dashboard/</a>										
            </p>									
        </div>
        <div class="col-lg-3">
            <div class="year-radios">
                <h4>Show Employment</h4>
                <div class="form-check">
                    <input class="form-check-input ho_yearRadio" type="radio" value="None" name="ho_yearRadio" id="ho_none" checked>
                    <label class="form-check-label" for="ho_none">
                        None
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ho_yearRadio" type="radio" value="2019" name="ho_yearRadio" id="ho_2019">
                    <label class="form-check-label" for="ho_2019">
                        2019
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ho_yearRadio" type="radio" value="2020" name="ho_yearRadio" id="ho_2020">
                    <label class="form-check-label" for="ho_2020">
                        2020
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ho_yearRadio" type="radio" value="2021" name="ho_yearRadio" id="ho_2021">
                    <label class="form-check-label" for="ho_2021">
                        2021
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ho_yearRadio" type="radio" value="2022" name="ho_yearRadio" id="ho_2022">
                    <label class="form-check-label" for="ho_2022">
                        2022
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input ho_yearRadio" type="radio" value="2023" name="ho_yearRadio" id="ho_2023">
                    <label class="form-check-label" for="ho_2023">
                        2023
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="collapsible collapsible-table">View Table</button>
    <div class="table-content">
        <table id="ho-table"></table>
    </div>
    <div class="Dwnload-btn mt-5">
      <a href="<?php echo $tracker_dir; ?>/downloads/chart-13_hotel_occupancy_2019-2023.csv" download="bc_tourism_hotel_occupancy_2019-2023.csv" target="_blank" class="green-btn"><i class="fa fa-download" aria-hidden="true"></i>Download Full Data</a>
    </div>
  </div>
  <br>
  <hr>
  1. <a onclick="showRef(1, 'tourism-definitions-button')" class="ref-link">^</a><a href="https://www.statcan.gc.ca/eng/subjects/standard/naics/2017/v3/introduction" target="_blank" name="footnote-1">https://www.statcan.gc.ca/eng/subjects/standard/naics/2017/v3/introduction</a><br>
  <br><br>
  <p>The views and opinions expressed in this report are those of its author(s) and not the official policy or position of the Government of British Columbia.<p>     
  <div class="text-center"><img src="<?php echo $tracker_dir; ?>/assets/Can_BC_LMDA.jpg"></div>
  <br><br>