### Is there any data missing from the file?
Yes.


See the question on which types of hospitals are missing from this data. Also note that influenza data is not currently required for reporting purposees.


When there are fewer than 4 patients in a data field the cell is redacted and replaced with -999999. This value was chosen to ensure that users would not make the mistake of quickly “averaging” a column to come to a conclusion that does not account for the fact that many of the cells contain too few patients to release (for privacy concerns). To conduct analysis on this data, one must decide how to handle the -999999 fields. 


There are some “null” values in the data. Facilities that do not have a CCN number will have missing data in those fields, for instance. 


Sometimes, a facility might fail to complete a daily report into the HHS Protect database. There is already two PUFs that are designed to shed light on the issue of hospital reporting consistency: 


* https://protect-public.hhs.gov/datasets/9f70e309bb324d3f96c49a3ead7be776/data?geometry=89.569%2C-16.702%2C-96.408%2C72.161&amp;orderBy=state_name
* https://healthdata.gov/covid-19-hospital-reporting-hospital-reporting-trend-dashboard


When this happens, the nature of this data release will change. For instance, if a hospital fails to report for two days, it will mean that the “average” and “total” reports will be based on 5 days of data rather than 7. Specifically, for many calculations, this means the use of a different denominator. 


It is possible that future versions of this dataset will include more fields, based on more complex reporting requirements over time. Also, it might be possible for earlier rows of data to be released. Early reporting requirements did not include all of the fields that power this data release. In both of these cases, when data “did not exist” in the underlying HHS protect database, the fields that rely on this missing underlying data will be NULL (i.e. blank in the csv file) in this data release.


