# Facility COVID PUF Community FAQ
This document answers frequently asked questions about the COVID-19 facility-level capacity data, initially released the week of Dec 7th, 2020. This is not a substitute for the data documentation. This FAQ was developed in collaboration with a group of data journalists, data scientists, and healthcare system researchers who have reviewed the data. If you have any questions, please [create a new Github issue](https://github.com/CareSet/covid_facility_capacity_puf/issues/new)! 



### Where to get this data?
You can get this data [from healthdata.gov](https://healthdata.gov/Hospital/COVID-19-Reported-Patient-Impact-and-Hospital-Capa/anag-cw7u)
And you can read the [HHS press release](https://www.hhs.gov/about/news/2020/12/07/hhs-publishes-covid-19-hospital-facility-level-data.html) about this release and the [HealthData.gov Blog entry about the data](https://healthdata.gov/hhs-publishes-covid-19-hospital-facility-level-data)

### What is this data and where does it come from?
Each row of data in this file represents the COVID-19 related capacity information for a single hospital facility, over the course of a seven day period. (Friday-Thursday). This data is reported by nearly every hospital to the Federal Government in the US each day.  This means that each row of data is based on the aggregated reporting for the previous week. 
 
Every day most hospitals in the U.S. are required to report information on the following topics to the federal government: 


* Hospital capacity, including information on ICU capacity and available ventilators
* Staffing levels, including any shortages
* How many patients are coming into the hospital with confirmed or suspected COVID-19 cases
* Many other relevant details that public health officials need to properly coordinate COVID responses 


To understand exactly what is in the data it is important to understand what is reported by hospitals each day. Please refer to the current version of the [COVID-19 Guidance for Hospital Reporting and FAQs For Hospitals, Hospital Laboratory, and Acute Care Facility Data Reporting](https://www.hhs.gov/sites/default/files/covid-19-faqs-hospitals-hospital-laboratory-acute-care-facility-data-reporting.pdf)

Note: The requirements for reporting data have changed since the release of this data. On Feb 2, 2022 influenza data and pediatric data became required. On January 19, 2022 the tracking of "Therapeutic D" option, which is the administration of sotrovimab, became required.


This data is reported daily from hospitals, either through the Teletracking system or through reports sent via State-level health departments, and entered into the central HHS Protect database.

If you would like to see the form that is used to gather this data, you can download [a print out of the Teletracker UI from this regulatory comment page](https://www.reginfo.gov/public/do/PRAViewIC?ref_nbr=202201-0990-001&icID=245355).


### What is the update schedule for this dataset?
This dataset snapshot is taken from Friday to Thursday and published every Monday.
This is a standard release schedule for most weekly HHS Protect data sets.


### Will more data fields be released?
This is a good question, and the HHS data teams are always looking for feedback on their dataset releases. They might even read tickets on this repo!! There is also a feedback mechanism on healthdata.gov.




### Is this data reliable?
This data accurately reflects the raw reporting that has been provided to the HHS Protect database. Before going into the HHS Protect database, this reporting data is modified only to correct obvious errors. For instance, if a hospital has been reporting that they have 10 available and staffed ICU beds for months, and then, suddenly are reporting that they have 23456789 beds, this value is reset to 10, based on the presumption that this was an accidental data entry error on the part of hospital personnel. Data correction efforts typically involve contacting the reporting hospital and ensuring that data fixes are in fact correct. 


Beyond these data corrections, it is improbable that modifications or censoring of the contents of the underlying data has occurred. These facility-level data reports have been aggregated and filtered only and precisely as described in the data documentation for the data. Outside beta-testers of the data have confirmed that previous data releases from HHS Protect line up with other publically available data sources, including those from states and other national resources available from CMS and the CDC. There is a history of cruft and other problems with the various data releases, but a careful examination of the slowly improving data releases makes it clear that the data has not been modified to fit any particular perspective or agenda about the COVID-19 crisis.  This is not to say that this data release or other releases are perfectly correct, but it does appear that these data releases are good-faith efforts to release accurate data.


Which in turn leads to its own issues. If hospital personnel accidentally type in that they have ‘11’ ICU beds, where in fact they only have 10, then this error might not be caught or corrected. It is also possible that hospitals will seek to amend their reports at a later time, based on improved information. The goal is to have a perfectly accurate daily reporting of dozens of complex values from thousands of facilities across the country. This is a lofty goal indeed. For each hospital report, hundreds of people are directly or indirectly involved, at the hospitals, state agencies, as well as Federal employees, and contractors. In many cases, these people have been working for months with no weekends or breaks. Some of them are basically either working on this or sleeping. At the hospital, especially at smaller facilities, personnel might be making the decision between working on reporting obligations and patient care. As more and more of the reporting process becomes automated and those automations are made fully reliable, the workload of individuals along the hospital reporting data pipeline has been reduced, and the quality of the underlying data is continuously improving. This is evidenced in the [graph of hospital reporting rates](https://healthdata.gov/covid-19-hospital-reporting-hospital-reporting-trend-dashboard) which shows more and more reporting fields being correctly reported every day by hospitals across the country. 


It is critical to remain empathetic with the front-line hospitals who are responsible for entering this data. They do so under very potentially stressful circumstances, and the reporting is most important exactly when things are most difficult at the hospital. Also, when HHS has made fields optional, hospitals should not be criticized for not reporting that information. Rather, hospitals that do report this information should be celebrated. 


The data release is not perfect, and expectations that the resulting data will be perfect are not reasonable. The right answer to the question “is the data reliable?” is not yes or no. The data has been reliable enough to be used in Federal response planning for some time and continues to improve each day. The reporting consistency is high enough now that the data is likely to become reliable enough for broad release to the public for dozens of purposes. 


Expect restatements. Given that hospitals will update past reporting to HHS, HHS will update the data with some kind of restatements. This will maintain transparency as to how reporting data capture changes over time. 


### Are there hospitals treating COVID patients in the U.S. that are not represented in this data?
Yes, there are several large groups of facilities that are not represented in this data. 


US Department of Veterans Affairs (VA) Hospitals, Defense Health Agency (DHA) and Indian Health Service (IHS) hospitals are not included in this data release. The data from these two federal agencies are included in the HHS Protect database, but the release of that data is not up to HHS (the agency releasing this data file), we hope to convince the VA and IHS to have parallel data releases, using equivalent data structures.


Psychiatric and rehabilitation hospitals are also omitted, as they are not centrally involved in the COVID-19 response. 
### How is this dataset aggregated?
This dataset is aggregated on a per-hospital, per-week basis. That means each hospital can appear more than once in the data file, with one additional row for each week of reporting. Hospitals are generally identified by the contract number they have with Medicare, which is called the “CCN”. This is not part of the primary identifier for the row, because some hospitals do not have a CCN number. This is why the hospital_pk exists (which is the hospital identifier in the file). Normally the hospital_pk field is just the CCN, but sometimes it is a programmatically generated identifier. 


CCN stands for CMS Certification Number. For more information on what the CCN is, look in the [CCN Manual](https://www.cms.gov/regulations-and-guidance/guidance/transmittals/downloads/r29soma.pdf).


There are a few hospital facilities that do not have CCN numbers in the database. There are also a few rows of data that share the same CCN between several facilities. There are very few of these hospitals (less than 33 in the first data release).




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


### What other data sources cover the same/similar information at the hospital level?


* U.S Hospital Reporting Dashboard from HHS Protect - https://protect-public.hhs.gov/pages/covid19-module 
* There is a capacity report aggregated at the state level that shows the same information, aggregated at the state level. https://healthdata.gov/dataset/covid-19-reported-patient-impact-and-hospital-capacity-state-timeseries 
* There is a report that State Level COVID capacity data https://healthdata.gov/dataset/covid-19-estimated-patient-impact-and-hospital-capacity-state 
* Daily deaths and hospitalizations https://healthdata.gov/dataset/covid-19-daily-cases-deaths-and-hospitalizations 
### What geographic analysis methods are possible with this data?
See the question about data linking for methods to link data into various census datasets. These datasets cover issues related to socioeconomic status, social determinants of health and other healthcare equity issues. There is also a field called is_metro_micro which can be used to quickly make a determination about how large a city the hospital is serving. This is a good way to quickly conduct a geographical analysis of rural vs urban settings in the reported data. This is based on the [Metropolitan vs Micropolitan distinction in Census data](https://www.census.gov/programs-surveys/metro-micro.html)
### What other organizations generate reports or data views on this data

* Covid Tracking Project https://covidtracking.com/
   * Map visualization coming soon 
* University of Minnesota Covid-19 Hospitalization Tracking Project  https://carlsonschool.umn.edu/mili-misrc-covid19-tracking-project
   * New County Level Dashboard 


### What is this data useful for?
Any analysis that seeks to understand how the COVID crisis has impacted local communities will be improved by considering this data. School systems that are making the decision about whether to open or close or how often students should be in class, can use this dataset to make those decisions based on how local hospitals are being impacted by COVID. Local fire departments can use this data as they direct their ambulances toward one hospital or another. (Although more recent capacity data will frequently be available to fire departments). States can use this data in order to validate their own understanding of their community’s needs. Journalists can use this story to better communicate how the COVID pandemic and the COVID response is impacting local communities. Academic researchers can use this data to understand the associations of hospitalizations, hospital capacity, and local community characteristics. 


There continue to be misinformation campaigns that deny the usefulness of masks or detract from other CDC recommendations, like social distancing. Many of these campaigns emphasize that the severity of the disease is less than it actually is. This dataset can be used to understand and model the regional impact of these misinformation campaigns, as well as provide direct evidence needed to combat them. 

### Should I analyze this data before seeking hospital treatment? Or defer treatment entirely?
NO. Per the HealthData.gov team, "Patients should not be discouraged from seeking hospital care based on their interpretation of the data. Hospitals have protocols in place to keep patients safe from exposure and to ensure all patients are prioritized for care."

### What is HHS Protect Data and its role in COVID-19 planning?
The Central HHS Protect database powers the highest level of COVID coordination in the United States. There are multiple Federal resources, including access to doses of Remdesivir, which are allocated based on the daily hospital reporting that ultimately goes into the HHS Protect Database. Other important resources include doctors from the DOD and other Federal teams that can be used to augment staff at local hospitals in emergency situations. 


All of the decisions about how these resources are distributed are sourced from insights gained from the data in the HHS Protect Database. This database is the most comprehensive and centrally-maintained picture of the COVID-19 pandemic in the Federal Government. As a result, this is likely to be the closest data picture to ground-truth on the COVID-19 pandemic in the United States. 


This is not the first dataset to be released to the public from HHS Protect. There is a publicly available website that features the data released from HHS Protect at [https://protect-public.hhs.gov/](https://protect-public.hhs.gov/).

### What about pediatric data?
Pediatric data is now required as of Feb 2, 2022. This is likely due to the rising cases of pediatric hospitalizations since the Omicron variant emergence.

### What is the structure of the data?
This is a CSV flat file and the structure is documented in the data dictionary.

### Why would the number of beds change week over week?
All of the bed numbers in the hospital data set are based on staffed beds.  It is possible that more beds exist in the hospital but only have staff to cover the number of beds reported.  This is why it’s possible to see a variance in the number of beds reported as well as physically added or eliminating beds from the hospital.

### Why would the number of inpatient beds or ICU beds change over time?
The reporting is rarely concerned with the number of beds at a facility. The issue is how many beds are staffed. If you have 100 beds in the hospital and 10 beds in an ICU, but a hospital only has enough nurses and doctors to support 50 of the hospital beds and 5 ICU beds, then the hospital would report 50 beds and 5 ICU beds available that day. As a result, the “bed capacity” is related to the number of actual beds in a facility and also the staffing available at the hospital. Over time, this number will fluctuate slightly. 




### How to make meaningful capacity metrics for further study?
As you seek to create meaningful metrics from this data, be aware that there are some “very small” numbers in some rows of data that should receive special attention in order to get meaningful information from metrics/ratios. Anyone analyzing this data, should remain aware of invalid ratios created by very small numbers.   	

| Example Metrics for Adult Hospitalizations  | Formula |
| ------------- | ------------- |
| How full is the hospital with adult confirmed and suspected COVID patients?  | total_adult_patients_hospitalized_confirmed_and_suspected_covid_7_day_avg/ all_adult_hospital_inpatient_beds_7_day_avg |
| Total staffed adult ICU bed fullness? (including COVID and non-COVID ICU usage)  | staffed_adult_icu_bed_occupancy_7_day_avg/ total_staffed_adult_icu_beds_7_day_avg  |
| How full is the adult ICU of confirmed and suspected COVID patients? | staffed_icu_adult_patients_confirmed_and_suspected_covid_7_day_avg/ total_staffed_adult_icu_beds_7_day_avg  |
| What proportion of currently hospitalized adult patients are COVID patients?  | total_adult_patients_hospitalized_confirmed_and_suspected_covid_7_day_avg /all_adult_hospital_inpatient_bed_occupied_7_day_avg  |



This is a list of ratios that it is not possible to calculate in this data release: 


* There are several pediatric ratios that are not possible to calculate. 


### Why would hospital data change over time?
As the central database is updated over time, new information becomes available. This is especially true for any hospital reporting that occurs one day late, before the day that a weekly snapshot of data is taken. So if the data file is released every Monday (for instance) and a specific hospital failed to report on Thursday, but then reports for the Thursday data on Tuesday. Subsequent data releases will include the updated hospital data, which will be slightly different than the data that is initially released. This is a “reporting lag” effect that is common to any complex reporting/surveillance process (the same kind of lag can happen with medical claim databases over time, for instance).

### Influenza data?
The reporting for influenza data from hospitals was added as a requirement starting Feb 2, 2022. Before this date, influenza data reporting was optional. It is important not to compare the influenza data from before this requirment with the data afterwards. Specifically, a hospital reporting no influenza data before this date should not be interpreted as having no influenza cases. 

### Is there any data missing from the file?
Yes.


When there are fewer than 4 patients in a data field the cell is redacted and replaced with -999999. This value was chosen to ensure that users would not make the mistake of quickly “averaging” a column to come to a conclusion that does not account for the fact that many of the cells contain too few patients to release (for privacy concerns). To conduct analysis on this data, one must decide how to handle the -999999 fields. 


There are some “null” values in the data. Facilities that do not have a CCN number will have missing data in those fields, for instance. 


Sometimes, a facility might fail to complete a daily report into the HHS Protect database. There is already two PUFs that are designed to shed light on the issue of hospital reporting consistency: 


* https://protect-public.hhs.gov/datasets/9f70e309bb324d3f96c49a3ead7be776/data?geometry=89.569%2C-16.702%2C-96.408%2C72.161&amp;orderBy=state_name
* https://healthdata.gov/covid-19-hospital-reporting-hospital-reporting-trend-dashboard


When this happens, the nature of this data release will change. For instance, if a hospital fails to report for two days, it will mean that the “average” and “total” reports will be based on 5 days of data rather than 7. Specifically, for many calculations, this means the use of a different denominator. 


It is possible that future versions of this dataset will include more fields, based on more complex reporting requirements over time. Also, it might be possible for earlier rows of data to be released. Early reporting requirements did not include all of the fields that power this data release. In both of these cases, when data “did not exist” in the underlying HHS protect database, the fields that rely on this missing underlying data will be NULL (i.e. blank in the csv file) in this data release.


### What type of file is this?
This is a comma delimited field file, called a “CSV file” for short.
CSV files are an open file format defined in [IETF RFC4180](https://tools.ietf.org/html/rfc4180) 
Generally government agencies are required to prefer data releases in open formats. 


There are many tutorials available online about how to import CSV files into your favorite data analysis platform. Also this file will open directly in any modern spreadsheet software. 


### Why are there -999999 values in the data? 
This is how HHS marks cells that have been redacted. See question [“Is there any data missing from the file?”](ReadMe.md#is-there-any-data-missing-from-the-file)

### How to compare this data to state-level data?
There are several differences between the data export process for the facility level and state-level data. They are aggregated over different time periods as well as at different regional aggregations. As a result, there will always be some differences between an analysis that is based on the state-level public use file vs a state-based analysis that is drawn from the state-field in the facility-aggregated dataset. There are multiple differences between these data frames, including data that is withheld for privacy reasons, that will make a perfect matchup between different Public Use Files (PUFs) impossible. This includes redactions resulting in -999999 in a given field. 


### How to examine regional (city/county) data with this dataset, what is new?
The impact on hospitals is very localized. The problem with releasing aggregated pictures is that this does NOT account for the way COVID-19 is affecting specific facilities. Aggregations will miss the fact that some facilities are at 105% capacity and others are less utilized. This is the reason why such data is released: to show a specific facility’s status, which could be dramatically different from the status of other hospitals in the same city, county and state.  




### I checked a hospital’s dashboard and the numbers are slightly different from the ones in this file. Why is that? 
First, it could be a data entry or aggregation error. (There are ways to provide feedback on this data at healthdata.gov.) However, there could be reasons for small discrepancies between an individual facility’s dashboard or internal reporting and this file, that are not mistakes of any kind. For one, this file provides a snapshot of the previous week’s data, so an individual facility’s reporting may be more up to date. The aggregations for hospital dashboards are typically daily, while this dataset is aggregated across a week (Friday-Thurs), and does not not represent any specific day. There could also be differences in data definitions between the ones HHS has settled on and any particular local facility. It seems trivial but what it means to have a “bed” is not actually that simple. This is also a frequent reason for small differences between state-level reports and national reports.  




### What does ‘coverage’ mean?
This is the number of days within the weekly reporting period (Friday-Thurs) that the hospital has currently submitted reports for. This number will range between 0 (no days reporting) and 7 (reported every day). 


### Are there semantic problems that make comparing this data difficult? 
Yes.
There are many semantic problems between different COVID datasets, but two significant semantic problems should be highlighted. 

1. The first is the distinction between “confirmed” and “suspected” COVID-19 cases. Sometimes these are merged into a single field called “cases”. This impacts how ICU beds are reported as well case counts. 

2. The second is what is meant by an “available bed”. Sometimes this number means “beds that are properly staffed” and sometimes this means “the number of literal beds”. 

Distinctions like this account for a substantial amount of the differences between data reported from various levels of government. 

### Are there are there other views available of this data?

The University of Minnesota COVID-19 Hospitalization Tracking Project allows data downloads of its county-level data average percent beds filled based on this data: 
https://carlsonschool.umn.edu/mili-misrc-covid19-tracking-project
Feel free to ask questions about this county roll up in the github issues for this repository, someone from the Carlson School will be paying attention!


### Therapeutics

As specific therapeutic approaches have proven themselves valuable, reporting of which approaches are used has become required, and 

* Therapeutic A (casirivimab/imdevimab)
* Therapeutic C (bamlanivimab/etesevimab)
• Therapeutic D (sotrovimab)

However, therapeutic data is not yet part of the released data. 

### Staffing Shortage data
For now, staffing shortage data does not exist at the facility level reporting. But is available at the regional aggregations.

### Critical issues

This is a list of issues submitted to this FAQ that contain relevant discussions on various topics. They are "closed" in the sense that we are not discussing them further, but they contain information that people should be aware of.

* [Document errors in OR / WA suspected pediatric admissions, state aggregate files](https://github.com/CareSet/COVID_Hospital_PUF/issues/24)
* [Obfuscation of true zeros](https://github.com/CareSet/COVID_Hospital_PUF/issues/21)
* [Tracking hospital aquired COVID infections](https://github.com/CareSet/COVID_Hospital_PUF/issues/19)
* [What does "inpatient" and "bed" mean in the data](https://github.com/CareSet/COVID_Hospital_PUF/issues/17)
* [Clarification on documentation of specific fields](https://github.com/CareSet/COVID_Hospital_PUF/issues/15)
* [strange data around specific CCNs](https://github.com/CareSet/COVID_Hospital_PUF/issues/14)
* [ICU bed usage during COVID spike](https://github.com/CareSet/COVID_Hospital_PUF/issues/13)
* [Interpreting over 100% capacity](https://github.com/CareSet/COVID_Hospital_PUF/issues/8)
* [How data will be archived](https://github.com/CareSet/COVID_Hospital_PUF/issues/6)
* [Intrepeting Staffing Levels](https://github.com/CareSet/COVID_Hospital_PUF/issues/5)
* 

### Who wrote this FAQ?
This FAQ is a collaboration between: 

* Data Journalists at [Careset Systems](https://www.careset.com)
* Researchers from the [University of Minnesota COVID-19 Hospitalization Tracking Project](https://carlsonschool.umn.edu/mili-misrc-covid19-tracking-project) at the Carlson School of Management - [Medical Industry Leadership Institute (MILI)](https://carlsonschool.umn.edu/faculty-research/medical-industry-leadership-institute) and the [Management Information Systems Research Center (MISRC)](https://carlsonschool.umn.edu/faculty-research/mis-research-center)
* Volunteers from [COVID Exit Strategy](https://www.covidexitstrategy.org)


### FYI Hospitals are safe
Thank you for your interest in HHS Open Data. One note -- Patients should not be discouraged from seeking hospital care based on their interpretation of the data. Hospitals have protocols in place to keep patients safe from exposure and to ensure all patients are prioritized for care.

    HealthData.gov Team

