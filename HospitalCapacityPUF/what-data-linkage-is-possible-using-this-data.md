### What data linkage is possible using this data?

* CCN

   * CCN links to several other data sets that are coded by CCN including hospital cost data https://www.cms.gov/Research-Statistics-Data-and-Systems/Statistics-Trends-and-Reports/Medicare-Provider-Cost-Report/HospitalCostPUF

* FIPS

   * Geographic linkages: 5-digit FIPS County codes allow for linkage into census delineation files (ie. CBSAs).  https://www.census.gov/programs-surveys/metro-micro/aboutdelineation-files.html

   * The county FIPS code can be used to link to geographic data from dartmouth atlas. https://www.dartmouthatlas.org/covid-19/hrr-mapping/

   * American Community Survey is coded by FIPS code https://www.census.gov/programs-surveys/acs

* AHRF

   * HRSA Area Health Resources Files https://data.hrsa.gov/topics/health-workforce/ahrf

* Hospital Name

   * Using the hospital name it is possible to lookup hospitals in the NPPES database. This data includes information like phone and fax number, as well as more information about the types of services offered at the facility. https://download.cms.gov/nppes/NPI_Files.html 

* Zip Code

   * Zip codes can be used to translate to census ZCTA fields https://www.census.gov/programs-surveys/geography/guidance/geo-areas/zctas.html

   * Zip codes are complex data types, we recommend you read the SmartyStreets ZipCode 101 document for more information on how they work https://smartystreets.com/docs/zip-codes-101

   * And the following article describing the use of Zip codes/ZCTA codes for epedimilogical research https://www.ncbi.nlm.nih.gov/pmc/articles/PMC1762013/

   * There are zip code to ZCTA crosswalks available https://udsmapper.org/zip-code-to-zcta-crosswalk/

   * You can use this to look into geofencing data through zip code like SafeGraph (https://www.safegraph.com/)

* Placekey

   * The crosswalk between _hospital_pk_ and [Placekey](https://www.placekey.io/) can help identify the hospital locations as well as be used to easily pair with 3rd party movement data, like [SafeGraph](https://www.safegraph.com/), to analyze foot-traffic data in and around each POI  




