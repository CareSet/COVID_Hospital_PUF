### How is this dataset aggregated?
This dataset is aggregated on a per-hospital, per-week basis. That means each hospital can appear more than once in the data file, with one additional row for each week of reporting. Hospitals are generally identified by the contract number they have with Medicare, which is called the “CCN”. This is not part of the primary identifier for the row, because some hospitals do not have a CCN number. This is why the hospital_pk exists (which is the hospital identifier in the file). Normally the hospital_pk field is just the CCN, but sometimes it is a programmatically generated identifier. 


CCN stands for CMS Certification Number. For more information on what the CCN is, look in the [CCN Manual](https://www.cms.gov/regulations-and-guidance/guidance/transmittals/downloads/r29soma.pdf).


There are a few hospital facilities that do not have CCN numbers in the database. There are also a few rows of data that share the same CCN between several facilities. There are very few of these hospitals (less than 33 in the first data release).




