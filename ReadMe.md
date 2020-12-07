# Facility COVID PUF Community FAQ
This document answers frequently asked questions about the COVID-19 facility-level capacity data, initially released the week of Dec 7th, 2020. This is not a substitute for the data documentation, which lives here[a]. This FAQ was developed in collaboration with a group of data journalists, data scientists, and healthcare system researchers who have reviewed the data. If you have any questions, please create a new Github issue! https://github.com/CareSet/covid_facility_capacity_puf/issues/new




Where to get this data?
What is this data and where does this data come from?
What is the update schedule for this dataset?
Will more data fields be released?
Is this data reliable?
Are there hospitals treating COVID patients in the U.S. that are not represented in this data?
How is this dataset aggregated?
What data linkage is possible using this data?
What other data sources cover the same/similar information at the hospital level?
What geographic analysis methods are possible with this data?
What other organizations generate reports or data views on this data?
What is this data useful for?
What about pediatric data?
What is the structure of the data and how is it different?
Why would the number of inpatient beds or ICU beds change over time?
How to make meaningful capacity metrics for further study?
Why would hospital data change slightly over time?
Is there any data missing from the file?
What type of file is this?
How to compare this data to state-level data?
How to examine regional (city/county) data with this dataset, what is new?
Who wrote this FAQ?








### Where to get this data?
You can get this data here: [b]https://healthdata.gov/dataset/covid-19-reported-patient-impact-and-hospital-capacity-facility
And you can read the HHS press release about this release here: 
### What is this data and where does this data come from?
Each row of data in this file represents the COVID-19 related capacity information for one single hospital facility, over the course of a single week. This data is reported by every hospital to the Federal Government in the US each day.  This means that each row of data is based on the reporting for a given week. 
 
Every day most hospitals in the U.S. are required to report information on the following topics to the federal government: 


* Hospital capacity, including information on ICU capacity and available ventilators
* Staffing levels including any shortages
* How many patients are coming into the hospital with confirmed or suspected COVID-19 cases
* Many other relevant details that public health officials need to understand in order to properly coordinate COVID responses. 


To understand exactly what is in the data, please refer to the current version of the “COVID-19 Guidance for Hospital Reporting and FAQsFor Hospitals, Hospital Laboratory, and Acute Care Facility Data Reporting” which available from: 
https://www.hhs.gov/sites/default/files/covid-19-faqs-hospitals-hospital-laboratory-acute-care-facility-data-reporting.pdf


This data is reported daily from hospitals, either through the Teletracking system or through reports sent via State health departments, and entered into the HHS Protect database.


### What is the update schedule for this dataset?
This dataset snapshot is taken from Friday to Thursday and published every Monday.
This is a standard release schedule for most weekly HHS Protect data sets.


### Will more data fields be released?
This is a good question, and the data team is always looking for feedback on their datasets. They might even read tickets on this repo!! There is also a feedback mechanism on healthdata.gov




### Is this data reliable?
This data accurately reflects the raw reporting that has been provided to the HHS Protect database. This data is modified only to correct obvious errors. For instance, if a hospital has been reporting that they have 10 available ICU beds for months, and then, suddenly are reporting that they have 23456789 beds, this value is reset to 10, based on the presumption that this was an accidental data entry error on the part of hospital personnel. Data correction efforts typically involve contacting the reporting hospital and ensuring that data fixes are in fact correct. 


Beyond these data corrections, no modification or censoring of the contents of the underlying data has occurred. These facility-level data reports have been aggregated and filtered only and precisely as described in the data documentation for the data. Outside beta-testers of the data have confirmed that these data line up with other publically available data sources, including those from states and other national resources available from CMS and the CDC. It is very likely that there is cruft and other problems with the data, but a careful examination of the data makes it clear that the data has not been modified to fit any particular perspective or story about the COVID crisis.  


Which in turn leads to its own issues. If hospital personnel accidentally type in that they have ‘11’ ICU beds, where in fact they only have 10, then this error might not be caught or corrected. It is also possible that hospitals will seek to amend their reports at a later time. The goal is perfectly accurate daily reporting of dozens of complex values from thousands of facilities across the country. For each hospital report, hundreds of people are directly or indirectly involved, at the hospitals, state agencies, as well as Federal employees, and contractors. In many cases, these people have been working for months with no weekends or breaks. Some of them are basically either working on this or sleeping. At the hospital, especially at smaller facilities, personnel might be making the decision between working on reporting obligations and patient care. As more and more of the reporting process becomes automated and those automations are made fully reliable, the workload of individuals along the data pipeline has been reduced, and the quality of the underlying data is continuously improving. 


But it is not perfect, and expectations that the resulting data will be perfect are not reasonable. The right answer to the question “is the data reliable?” is not yes or no. The data has been reliable enough to be used in Federal response planning for some time and continues to improve each day. The reporting consistency is high enough now that the data is likely to become reliable enough for broad release to the public for dozens of purposes. 


Expect restatements.  Given hospitals will update past reporting to HHS, HHS will update the data with restatements.  This will maintain transparency as to the true impact and the data capture over time. 


### Are there hospitals treating COVID patients in the U.S. that are not represented in this data?
Yes, there are at least two other large groups of facilities that are not represented in this data: US Department of Veterans Affairs (VA) Hospitals and Indian Health Service (IHS) hospitals. The data from these two federal agencies are included in the HHS Protect database, but the release of that data is not up to HHS (the agency releasing this data file), we hope to convince the VA and IHS to have parallel data releases, using an equivalent data structure.


Psychiatric and rehabilitation hospitals are also omitted. 
### How is this dataset aggregated?
This dataset is aggregated a on per-hospital, per-week basis. That means each hospital can appear more than once in the data, one additional row for each week. Hospitals are generally identified by the contract number they have with Medicare, which is called the “CCN”. This is not the identifier for the row, because some hospitals do not have a CCN number. This is why the hospital_pk (which is the hospital identifier in the file) is usually just the CCN. 


CCN stands for CMS Certification Number. For more information on what the CCN is found in the CCN Manual: https://www.cms.gov/regulations-and-guidance/guidance/transmittals/downloads/r29soma.pdf


There are a few hospital facilities that do not have CCN numbers in the database. There are also a few rows of data that share the same CCN between several facilities. This is the reason why the ‘hospital_pk’ variable exists. There are very few of these hospitals (less than 33 in the first data release).




### What data linkage is possible using this data?
* CCN
   * CCN links to several other data sets that are coded by CCN including hospital cost data https://www.cms.gov/Research-Statistics-Data-and-Systems/Statistics-Trends-and-Reports/Medicare-Provider-Cost-Report/HospitalCostPUF
* FIPS
   * Geographic linkages: 5-digit FIPS County codes allow for linkage into census delineation files (ie. CBSAs).  https://www.census.gov/programs-surveys/metro-micro/aboutdelineation-files.html
   * The county FIPS code can be used to link to geographic data from dartmouth atlas. https://www.dartmouthatlas.org/covid-19/hrr-mapping/
   * American Community Survey is coded by FIPS code https://www.census.gov/programs-surveys/acs
* AHRF
HRSA Area Health Resources Files https://data.hrsa.gov/topics/health-workforce/ahrf
* Hospital Name
* Using the hospital name it is possible to lookup hospitals in the NPPES database. This data includes information like phone and fax number, as well as more information about the types of services offered at the facility. https://download.cms.gov/nppes/NPI_Files.html Zip Code
   * Zip codes can be used to census ZCTA https://www.census.gov/programs-surveys/geography/guidance/geo-areas/zctas.html
   * Zip codes are complex data types, we recommend you read the SmartyStreets ZipCode 101 document for more information https://smartystreets.com/docs/zip-codes-101
   * And the following article describing the use of Zip codes/ZCTA codes for epedimilogical research https://www.ncbi.nlm.nih.gov/pmc/articles/PMC1762013/
   * There are zip code to ZCTA crosswalks available https://udsmapper.org/zip-code-to-zcta-crosswalk/
   * You can use this to look into geofencing data through zip code like SafeGraph (https://www.safegraph.com/)


### What other data sources cover the same/similar information at the hospital level?


* U.S Hospital Reporting Dashboard - https://protect-public.hhs.gov/pages/covid19-module 
* There is a capacity report aggregated at the state level that shows the same information, aggregated at the state level. https://healthdata.gov/dataset/covid-19-reported-patient-impact-and-hospital-capacity-state-timeseries 
* Estimated State Level COVID capacity data https://healthdata.gov/dataset/covid-19-estimated-patient-impact-and-hospital-capacity-state 
* Daily deaths and hospitalizations https://healthdata.gov/dataset/covid-19-daily-cases-deaths-and-hospitalizations 


### What geographic analysis methods are possible with this data?
See the question about data linking for methods to link data into various census dataset. These datasets cover issues related to socioeconomic status and other social determinants of health. There is also a field called is_metro_micro which can be used to quickly make a determination about how large a city the hospital is serving. This is a good way to quickly conduct a geographical analysis of rural vs urban settings. This is based on the Metropolitan vs Micropolitan distinction in Census data: https://www.census.gov/programs-surveys/metro-micro.html
### What other organizations generate reports or data views on this data?


* Covid Tracking Project https://covidtracking.com/
   * Map visualization coming soon 
* University of Minnesota Covid-19 Hospitalization Tracking Project  https://carlsonschool.umn.edu/mili-misrc-covid19-tracking-project
   * New County Level Dashboard 






### What is this data useful for?
Any analysis that seeks to understand how the COVID crisis has impacted local communities will be improved by considering this data. School systems that are making the decision about whether to open or close or how often students should be in class, can use this dataset to make those decisions based on how local hospitals are being impacted by COVID. Local fire departments can use this data as they direct their ambulances towards one hospital and towards another. States can use this data in order to validate their own understanding of their community’s needs. Journalists can use this story to better communicate how the COVID pandemic and the COVID response is impacting local communities. Academic researchers can use this data to understand the associations of hospitalizations, hospital capacity, and local community characteristics. 


There continue to be misinformation campaigns that deny the usefulness of masks or detract from other CDC recommendations, like social distancing. This dataset can be used to understand and model the regional impact of these misinformation campaigns, as well as direct evidence to combat them. 




### What about pediatric data?
There is information about pediatric cases and pediatric hospitals are included in the dataset. However, there is currently no information about how full pediatric ICUs are in this data release. Generally pediatric data is not reported, given that pediatric infection is relatively rare, and in order to ensure that reporting is as simple as possible for hospitals. 
### What is the structure of the data and how is it different?
This is a CSV flat file and the structure is documented in the data dictionary. 




### Why would the number of inpatient beds or ICU beds change over time?
The reporting is rarely concerned with the number of beds at a facility. The issue is how many beds are staffed. If you have 100 beds in the hospital and 10 beds in an ICU, but a hospital only has enough nurses and doctors to support 50 of the hospital beds and 5 ICU beds, then the hospital would report 50 beds and 5 ICU beds available that day. As a result, the “bed capacity” is related to the number of actual beds in a facility and also the staffing available at the hospital. 




### How to make meaningful capacity metrics for further study?
As you seek to create meaningful ratios in this data… be aware that there are some “very small” numbers in some rows of data that should be filtered out in order to get meaningful information from ratios. For this reason, users should remain aware of invalid ratios created by very small numbers.   


Example Metrics for Adult Hospitalizations
	Formula
	How full is the hospital with adult confirmed and suspected COVID patients? 
	total_adult_patients_hospitalized_confirmed_and_suspected_covid_7_day_avg
 / all_adult_hospital_inpatient_beds_7_day_avg
  
	Total staffed adult ICU bed fullness? (including COVID and non-COVID ICU usage) 
	staffed_adult_icu_bed_occupancy_7_day_avg
  / total_staffed_adult_icu_beds_7_day_avg 
	How full is the adult ICU of confirmed and suspected COVID patients?
	staffed_icu_adult_patients_confirmed_and_suspected_covid_7_day_avg
  / total_staffed_adult_icu_beds_7_day_avg 
	What proportion of currently hospitalized adult patients are COVID patients?
	total_adult_patients_hospitalized_confirmed_and_suspected_covid_7_day_avg / all_adult_hospital_inpatient_bed_occupied_7_day_average


	



List of ratios that it is not possible to calculate in this data release: 


* There are several pediatric ratios that are not possible to calculate. 


### Why would hospital data change slightly over time?
As the file is updated over time, new information becomes available. This is especially true for any hospital reporting that occurs one day late, before the day that a weekly snapshot of data is taken. So if the file is released every Monday (for instance) and a specific hospital failed to report on Sunday, but then reports for the Sunday data on Tuesday. Subsequent data releases will include the updated hospital data, which will be slightly different than initially released. This is a “reporting lag” effect that is common to any complex reporting/surveillance process (the same kind of lag can happen with medical claim databases over time, for instance).




### Is there any data missing from the file?
Yes.


See the question on hospitals that are missing from this data.


When there are fewer than than 4 patients in a data field the cell is redacted and replaced with -999999


There are some “null” values in the data. Facilities that do not have a CCN number will have missing data in those fields. 


Sometimes, a facility might fail to complete a daily report into the HHS Protect database. There is already two PUFs that are designed to shed light on the issue of reporting consistency: 


* https://protect-public.hhs.gov/datasets/9f70e309bb324d3f96c49a3ead7be776/data?geometry=89.569%2C-16.702%2C-96.408%2C72.161&amp;orderBy=state_name
* https://healthdata.gov/covid-19-hospital-reporting-hospital-reporting-trend-dashboard


When this happens, the nature of this data release will change. For instance, if a hospital fails to report for two days, it will mean that the “average” and “total” reports will be based on 5 days of data rather than 7. Specifically, for many calculations, this will be a different denominator. 


It is possible that future versions of this dataset will include more fields, based on more complex reporting requirements over time. Also, it might be possible for earlier rows of data to be released, when reporting was simpler than it is now. In both of these cases, when a row of data “did not exist” in the underlying HHS protect database, the fields that rely on these will be NULL (i.e. blank in the csv file)


### What type of file is this?
This is a comma delimited field file, called a “CSV File” for short.
CSV files are an open file format defined in IETF RFC4180 https://tools.ietf.org/html/rfc4180 
Generally government agencies are required to prefer data releases in open formats. 


There are many tutorials available online about how to import CSV files into your favorite data analysis platform. Also this file will open directly in any spreadsheet software. 


### Why are there -999999 values in the data? 
This is how HHS marks cells that have been redacted. See question “Is there any data missing from the file?”
### How to compare this data to state-level data?
There are several differences between the data export process for the facility level and state-level data. They are aggregated over different time periods as well as at different regional aggregations. As a result, there will always be some differences between an analysis that is based on the state-level public use file vs a state-based analysis that is drawn from the state-field in the facility-aggregated dataset. There are multiple differences between these data frames, including data that is withheld for privacy reasons, that will make a perfect matchup between different Public Use Files (PUFs) impossible.  Those redactions result in -999999 in the field. 


### How to examine regional (city/county) data with this dataset, what is new?
The impact on hospitals is very localized. The problem with releasing aggregated pictures is that this does NOT account for the way COVID-19 is affecting specific facilities.  Aggregations will miss the fact that some facilities are 105% and others are less utilized.  Hence, this is the reason why such data is released: to show a specific facility’s status.  




### I checked a hospital’s dashboard and the numbers are slightly different from the ones in this file. Why is that? 


First, of course, it could be a data entry or aggregation error. (And there are ways to provide feedback on this data at healthdata.gov.) However, there could be many reasons for small discrepancies between an individual facility’s dashboard or internal reporting and this file. For one, this file provides a snapshot of the previous week’s data, so an individual facility’s reporting may be more up to date. There could also be differences in data definitions between the ones HHS has settled on and any particular local facility. 


### Who wrote this FAQ?
This FAQ is a collaboration between: 


* Data Journalists at Careset Systems
* Researchers from the University of Minnesota COVID-19 Hospitalization Tracking Project at the Carlson School of Management - Medical Industry Leadership Institute (MILI) and the Management Information Systems Research Center (MISRC) 
[a]TODO link to data documentation.
[b]TODO Add download link and press release link

