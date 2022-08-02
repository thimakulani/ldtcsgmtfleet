var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// gmt_fleet_register table
gmt_fleet_register_addTip=["",spacer+"This option allows all members of the group to add records to the 'GMT Fleet Register:' table. A member who adds a record to the table becomes the 'owner' of that record."];

gmt_fleet_register_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'GMT Fleet Register:' table."];
gmt_fleet_register_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'GMT Fleet Register:' table."];
gmt_fleet_register_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'GMT Fleet Register:' table."];
gmt_fleet_register_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'GMT Fleet Register:' table."];

gmt_fleet_register_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'GMT Fleet Register:' table."];
gmt_fleet_register_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'GMT Fleet Register:' table."];
gmt_fleet_register_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'GMT Fleet Register:' table."];
gmt_fleet_register_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'GMT Fleet Register:' table, regardless of their owner."];

gmt_fleet_register_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'GMT Fleet Register:' table."];
gmt_fleet_register_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'GMT Fleet Register:' table."];
gmt_fleet_register_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'GMT Fleet Register:' table."];
gmt_fleet_register_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'GMT Fleet Register:' table."];

// log_sheet table
log_sheet_addTip=["",spacer+"This option allows all members of the group to add records to the 'Trip & Fuel Log Sheet:' table. A member who adds a record to the table becomes the 'owner' of that record."];

log_sheet_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Trip & Fuel Log Sheet:' table."];

log_sheet_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Trip & Fuel Log Sheet:' table, regardless of their owner."];

log_sheet_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Trip & Fuel Log Sheet:' table."];
log_sheet_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Trip & Fuel Log Sheet:' table."];

// vehicle_history table
vehicle_history_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle General History:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_history_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle General History:' table."];
vehicle_history_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle General History:' table."];
vehicle_history_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle General History:' table."];
vehicle_history_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle General History:' table."];

vehicle_history_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle General History:' table."];
vehicle_history_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle General History:' table."];
vehicle_history_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle General History:' table."];
vehicle_history_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle General History:' table, regardless of their owner."];

vehicle_history_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle General History:' table."];
vehicle_history_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle General History:' table."];
vehicle_history_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle General History:' table."];
vehicle_history_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle General History:' table."];

// year_model table
year_model_addTip=["",spacer+"This option allows all members of the group to add records to the 'Year Model:' table. A member who adds a record to the table becomes the 'owner' of that record."];

year_model_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Year Model:' table."];
year_model_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Year Model:' table."];
year_model_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Year Model:' table."];
year_model_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Year Model:' table."];

year_model_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Year Model:' table."];
year_model_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Year Model:' table."];
year_model_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Year Model:' table."];
year_model_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Year Model:' table, regardless of their owner."];

year_model_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Year Model:' table."];
year_model_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Year Model:' table."];
year_model_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Year Model:' table."];
year_model_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Year Model:' table."];

// month table
month_addTip=["",spacer+"This option allows all members of the group to add records to the 'Month:' table. A member who adds a record to the table becomes the 'owner' of that record."];

month_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Month:' table."];
month_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Month:' table."];
month_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Month:' table."];
month_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Month:' table."];

month_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Month:' table."];
month_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Month:' table."];
month_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Month:' table."];
month_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Month:' table, regardless of their owner."];

month_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Month:' table."];
month_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Month:' table."];
month_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Month:' table."];
month_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Month:' table."];

// body_type table
body_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Body Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

body_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Body Type:' table."];
body_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Body Type:' table."];
body_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Body Type:' table."];
body_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Body Type:' table."];

body_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Body Type:' table."];
body_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Body Type:' table."];
body_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Body Type:' table."];
body_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Body Type:' table, regardless of their owner."];

body_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Body Type:' table."];
body_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Body Type:' table."];
body_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Body Type:' table."];
body_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Body Type:' table."];

// vehicle_colour table
vehicle_colour_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle Colour:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_colour_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle Colour:' table."];
vehicle_colour_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle Colour:' table."];
vehicle_colour_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle Colour:' table."];
vehicle_colour_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle Colour:' table."];

vehicle_colour_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle Colour:' table."];
vehicle_colour_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle Colour:' table."];
vehicle_colour_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle Colour:' table."];
vehicle_colour_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle Colour:' table, regardless of their owner."];

vehicle_colour_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle Colour:' table."];
vehicle_colour_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle Colour:' table."];
vehicle_colour_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle Colour:' table."];
vehicle_colour_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle Colour:' table."];

// province table
province_addTip=["",spacer+"This option allows all members of the group to add records to the 'Province:' table. A member who adds a record to the table becomes the 'owner' of that record."];

province_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Province:' table."];
province_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Province:' table."];
province_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Province:' table."];
province_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Province:' table."];

province_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Province:' table."];
province_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Province:' table."];
province_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Province:' table."];
province_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Province:' table, regardless of their owner."];

province_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Province:' table."];
province_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Province:' table."];
province_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Province:' table."];
province_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Province:' table."];

// departments table
departments_addTip=["",spacer+"This option allows all members of the group to add records to the 'Departments:' table. A member who adds a record to the table becomes the 'owner' of that record."];

departments_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Departments:' table."];
departments_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Departments:' table."];
departments_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Departments:' table."];
departments_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Departments:' table."];

departments_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Departments:' table."];
departments_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Departments:' table."];
departments_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Departments:' table."];
departments_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Departments:' table, regardless of their owner."];

departments_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Departments:' table."];
departments_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Departments:' table."];
departments_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Departments:' table."];
departments_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Departments:' table."];

// districts table
districts_addTip=["",spacer+"This option allows all members of the group to add records to the 'Districts and Stations:' table. A member who adds a record to the table becomes the 'owner' of that record."];

districts_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Districts and Stations:' table."];
districts_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Districts and Stations:' table."];
districts_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Districts and Stations:' table."];
districts_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Districts and Stations:' table."];

districts_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Districts and Stations:' table."];
districts_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Districts and Stations:' table."];
districts_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Districts and Stations:' table."];
districts_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Districts and Stations:' table, regardless of their owner."];

districts_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Districts and Stations:' table."];
districts_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Districts and Stations:' table."];
districts_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Districts and Stations:' table."];
districts_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Districts and Stations:' table."];

// application_status table
application_status_addTip=["",spacer+"This option allows all members of the group to add records to the 'Application Status:' table. A member who adds a record to the table becomes the 'owner' of that record."];

application_status_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Application Status:' table."];
application_status_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Application Status:' table."];
application_status_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Application Status:' table."];
application_status_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Application Status:' table."];

application_status_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Application Status:' table."];
application_status_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Application Status:' table."];
application_status_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Application Status:' table."];
application_status_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Application Status:' table, regardless of their owner."];

application_status_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Application Status:' table."];
application_status_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Application Status:' table."];
application_status_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Application Status:' table."];
application_status_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Application Status:' table."];

// vehicle_payments table
vehicle_payments_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle Payments:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_payments_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle Payments:' table."];
vehicle_payments_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle Payments:' table."];
vehicle_payments_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle Payments:' table."];
vehicle_payments_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle Payments:' table."];

vehicle_payments_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle Payments:' table."];
vehicle_payments_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle Payments:' table."];
vehicle_payments_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle Payments:' table."];
vehicle_payments_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle Payments:' table, regardless of their owner."];

vehicle_payments_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle Payments:' table."];
vehicle_payments_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle Payments:' table."];
vehicle_payments_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle Payments:' table."];
vehicle_payments_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle Payments:' table."];

// insurance_payments table
insurance_payments_addTip=["",spacer+"This option allows all members of the group to add records to the 'Insurance Payments:' table. A member who adds a record to the table becomes the 'owner' of that record."];

insurance_payments_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Insurance Payments:' table."];
insurance_payments_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Insurance Payments:' table."];
insurance_payments_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Insurance Payments:' table."];
insurance_payments_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Insurance Payments:' table."];

insurance_payments_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Insurance Payments:' table."];
insurance_payments_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Insurance Payments:' table."];
insurance_payments_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Insurance Payments:' table."];
insurance_payments_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Insurance Payments:' table, regardless of their owner."];

insurance_payments_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Insurance Payments:' table."];
insurance_payments_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Insurance Payments:' table."];
insurance_payments_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Insurance Payments:' table."];
insurance_payments_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Insurance Payments:' table."];

// authorizations table
authorizations_addTip=["",spacer+"This option allows all members of the group to add records to the 'Authorization Report:' table. A member who adds a record to the table becomes the 'owner' of that record."];

authorizations_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Authorization Report:' table."];
authorizations_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Authorization Report:' table."];
authorizations_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Authorization Report:' table."];
authorizations_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Authorization Report:' table."];

authorizations_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Authorization Report:' table."];
authorizations_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Authorization Report:' table."];
authorizations_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Authorization Report:' table."];
authorizations_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Authorization Report:' table, regardless of their owner."];

authorizations_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Authorization Report:' table."];
authorizations_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Authorization Report:' table."];
authorizations_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Authorization Report:' table."];
authorizations_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Authorization Report:' table."];

// service table
service_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service:' table."];
service_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service:' table."];
service_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service:' table."];
service_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service:' table."];

service_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service:' table."];
service_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service:' table."];
service_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service:' table."];
service_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service:' table, regardless of their owner."];

service_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service:' table."];
service_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service:' table."];
service_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service:' table."];
service_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service:' table."];

// service_type table
service_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Type:' table."];
service_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Type:' table."];
service_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Type:' table."];
service_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Type:' table."];

service_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Type:' table."];
service_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Type:' table."];
service_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Type:' table."];
service_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Type:' table, regardless of their owner."];

service_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Type:' table."];
service_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Type:' table."];
service_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Type:' table."];
service_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Type:' table."];

// schedule table
schedule_addTip=["",spacer+"This option allows all members of the group to add records to the 'Schedule:' table. A member who adds a record to the table becomes the 'owner' of that record."];

schedule_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Schedule:' table."];
schedule_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Schedule:' table."];
schedule_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Schedule:' table."];
schedule_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Schedule:' table."];

schedule_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Schedule:' table."];
schedule_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Schedule:' table."];
schedule_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Schedule:' table."];
schedule_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Schedule:' table, regardless of their owner."];

schedule_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Schedule:' table."];
schedule_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Schedule:' table."];
schedule_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Schedule:' table."];
schedule_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Schedule:' table."];

// service_records table
service_records_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Records:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_records_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Records:' table."];
service_records_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Records:' table."];
service_records_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Records:' table."];
service_records_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Records:' table."];

service_records_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Records:' table."];
service_records_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Records:' table."];
service_records_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Records:' table."];
service_records_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Records:' table, regardless of their owner."];

service_records_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Records:' table."];
service_records_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Records:' table."];
service_records_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Records:' table."];
service_records_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Records:' table."];

// service_categories table
service_categories_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Categories:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_categories_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Categories:' table."];
service_categories_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Categories:' table."];
service_categories_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Categories:' table."];
service_categories_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Categories:' table."];

service_categories_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Categories:' table."];
service_categories_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Categories:' table."];
service_categories_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Categories:' table."];
service_categories_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Categories:' table, regardless of their owner."];

service_categories_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Categories:' table."];
service_categories_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Categories:' table."];
service_categories_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Categories:' table."];
service_categories_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Categories:' table."];

// service_item_type table
service_item_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Item Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_item_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Item Type:' table."];
service_item_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Item Type:' table."];
service_item_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Item Type:' table."];
service_item_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Item Type:' table."];

service_item_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Item Type:' table."];
service_item_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Item Type:' table."];
service_item_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Item Type:' table."];
service_item_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Item Type:' table, regardless of their owner."];

service_item_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Item Type:' table."];
service_item_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Item Type:' table."];
service_item_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Item Type:' table."];
service_item_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Item Type:' table."];

// service_item table
service_item_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Item:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_item_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Item:' table."];
service_item_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Item:' table."];
service_item_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Item:' table."];
service_item_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Item:' table."];

service_item_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Item:' table."];
service_item_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Item:' table."];
service_item_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Item:' table."];
service_item_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Item:' table, regardless of their owner."];

service_item_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Item:' table."];
service_item_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Item:' table."];
service_item_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Item:' table."];
service_item_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Item:' table."];

// purchase_orders table
purchase_orders_addTip=["",spacer+"This option allows all members of the group to add records to the 'Purchase Orders:' table. A member who adds a record to the table becomes the 'owner' of that record."];

purchase_orders_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Purchase Orders:' table."];
purchase_orders_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Purchase Orders:' table."];
purchase_orders_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Purchase Orders:' table."];
purchase_orders_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Purchase Orders:' table."];

purchase_orders_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Purchase Orders:' table."];
purchase_orders_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Purchase Orders:' table."];
purchase_orders_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Purchase Orders:' table."];
purchase_orders_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Purchase Orders:' table, regardless of their owner."];

purchase_orders_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Purchase Orders:' table."];
purchase_orders_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Purchase Orders:' table."];
purchase_orders_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Purchase Orders:' table."];
purchase_orders_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Purchase Orders:' table."];

// transmission table
transmission_addTip=["",spacer+"This option allows all members of the group to add records to the 'Transmission:' table. A member who adds a record to the table becomes the 'owner' of that record."];

transmission_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Transmission:' table."];
transmission_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Transmission:' table."];
transmission_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Transmission:' table."];
transmission_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Transmission:' table."];

transmission_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Transmission:' table."];
transmission_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Transmission:' table."];
transmission_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Transmission:' table."];
transmission_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Transmission:' table, regardless of their owner."];

transmission_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Transmission:' table."];
transmission_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Transmission:' table."];
transmission_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Transmission:' table."];
transmission_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Transmission:' table."];

// fuel_type table
fuel_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Fuel Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

fuel_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Fuel Type:' table."];
fuel_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Fuel Type:' table."];
fuel_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Fuel Type:' table."];
fuel_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Fuel Type:' table."];

fuel_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Fuel Type:' table."];
fuel_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Fuel Type:' table."];
fuel_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Fuel Type:' table."];
fuel_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Fuel Type:' table, regardless of their owner."];

fuel_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Fuel Type:' table."];
fuel_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Fuel Type:' table."];
fuel_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Fuel Type:' table."];
fuel_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Fuel Type:' table."];

// merchant table
merchant_addTip=["",spacer+"This option allows all members of the group to add records to the 'Merchant :' table. A member who adds a record to the table becomes the 'owner' of that record."];

merchant_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Merchant :' table."];
merchant_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Merchant :' table."];
merchant_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Merchant :' table."];
merchant_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Merchant :' table."];

merchant_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Merchant :' table."];
merchant_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Merchant :' table."];
merchant_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Merchant :' table."];
merchant_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Merchant :' table, regardless of their owner."];

merchant_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Merchant :' table."];
merchant_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Merchant :' table."];
merchant_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Merchant :' table."];
merchant_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Merchant :' table."];

// merchant_type table
merchant_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Merchant  Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

merchant_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Merchant  Type:' table."];
merchant_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Merchant  Type:' table."];
merchant_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Merchant  Type:' table."];
merchant_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Merchant  Type:' table."];

merchant_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Merchant  Type:' table."];
merchant_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Merchant  Type:' table."];
merchant_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Merchant  Type:' table."];
merchant_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Merchant  Type:' table, regardless of their owner."];

merchant_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Merchant  Type:' table."];
merchant_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Merchant  Type:' table."];
merchant_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Merchant  Type:' table."];
merchant_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Merchant  Type:' table."];

// manufacturer table
manufacturer_addTip=["",spacer+"This option allows all members of the group to add records to the 'Manufacturer:' table. A member who adds a record to the table becomes the 'owner' of that record."];

manufacturer_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Manufacturer:' table."];
manufacturer_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Manufacturer:' table."];
manufacturer_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Manufacturer:' table."];
manufacturer_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Manufacturer:' table."];

manufacturer_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Manufacturer:' table."];
manufacturer_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Manufacturer:' table."];
manufacturer_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Manufacturer:' table."];
manufacturer_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Manufacturer:' table, regardless of their owner."];

manufacturer_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Manufacturer:' table."];
manufacturer_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Manufacturer:' table."];
manufacturer_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Manufacturer:' table."];
manufacturer_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Manufacturer:' table."];

// manufacturer_type table
manufacturer_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Manufacturer Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

manufacturer_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Manufacturer Type:' table."];
manufacturer_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Manufacturer Type:' table."];
manufacturer_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Manufacturer Type:' table."];
manufacturer_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Manufacturer Type:' table."];

manufacturer_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Manufacturer Type:' table."];
manufacturer_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Manufacturer Type:' table."];
manufacturer_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Manufacturer Type:' table."];
manufacturer_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Manufacturer Type:' table, regardless of their owner."];

manufacturer_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Manufacturer Type:' table."];
manufacturer_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Manufacturer Type:' table."];
manufacturer_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Manufacturer Type:' table."];
manufacturer_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Manufacturer Type:' table."];

// driver table
driver_addTip=["",spacer+"This option allows all members of the group to add records to the 'Driver:' table. A member who adds a record to the table becomes the 'owner' of that record."];

driver_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Driver:' table."];
driver_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Driver:' table."];
driver_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Driver:' table."];
driver_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Driver:' table."];

driver_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Driver:' table."];
driver_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Driver:' table."];
driver_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Driver:' table."];
driver_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Driver:' table, regardless of their owner."];

driver_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Driver:' table."];
driver_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Driver:' table."];
driver_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Driver:' table."];
driver_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Driver:' table."];

// accidents table
accidents_addTip=["",spacer+"This option allows all members of the group to add records to the 'Accident:' table. A member who adds a record to the table becomes the 'owner' of that record."];

accidents_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Accident:' table."];
accidents_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Accident:' table."];
accidents_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Accident:' table."];
accidents_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Accident:' table."];

accidents_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Accident:' table."];
accidents_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Accident:' table."];
accidents_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Accident:' table."];
accidents_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Accident:' table, regardless of their owner."];

accidents_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Accident:' table."];
accidents_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Accident:' table."];
accidents_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Accident:' table."];
accidents_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Accident:' table."];

// accident_type table
accident_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Accident Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

accident_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Accident Type:' table."];
accident_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Accident Type:' table."];
accident_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Accident Type:' table."];
accident_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Accident Type:' table."];

accident_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Accident Type:' table."];
accident_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Accident Type:' table."];
accident_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Accident Type:' table."];
accident_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Accident Type:' table, regardless of their owner."];

accident_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Accident Type:' table."];
accident_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Accident Type:' table."];
accident_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Accident Type:' table."];
accident_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Accident Type:' table."];

// claim table
claim_addTip=["",spacer+"This option allows all members of the group to add records to the 'Claims:' table. A member who adds a record to the table becomes the 'owner' of that record."];

claim_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Claims:' table."];
claim_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Claims:' table."];
claim_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Claims:' table."];
claim_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Claims:' table."];

claim_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Claims:' table."];
claim_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Claims:' table."];
claim_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Claims:' table."];
claim_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Claims:' table, regardless of their owner."];

claim_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Claims:' table."];
claim_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Claims:' table."];
claim_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Claims:' table."];
claim_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Claims:' table."];

// claim_status table
claim_status_addTip=["",spacer+"This option allows all members of the group to add records to the 'Claims Status:' table. A member who adds a record to the table becomes the 'owner' of that record."];

claim_status_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Claims Status:' table."];
claim_status_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Claims Status:' table."];
claim_status_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Claims Status:' table."];
claim_status_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Claims Status:' table."];

claim_status_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Claims Status:' table."];
claim_status_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Claims Status:' table."];
claim_status_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Claims Status:' table."];
claim_status_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Claims Status:' table, regardless of their owner."];

claim_status_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Claims Status:' table."];
claim_status_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Claims Status:' table."];
claim_status_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Claims Status:' table."];
claim_status_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Claims Status:' table."];

// claim_category table
claim_category_addTip=["",spacer+"This option allows all members of the group to add records to the 'Claims Category:' table. A member who adds a record to the table becomes the 'owner' of that record."];

claim_category_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Claims Category:' table."];
claim_category_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Claims Category:' table."];
claim_category_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Claims Category:' table."];
claim_category_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Claims Category:' table."];

claim_category_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Claims Category:' table."];
claim_category_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Claims Category:' table."];
claim_category_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Claims Category:' table."];
claim_category_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Claims Category:' table, regardless of their owner."];

claim_category_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Claims Category:' table."];
claim_category_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Claims Category:' table."];
claim_category_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Claims Category:' table."];
claim_category_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Claims Category:' table."];

// cost_centre table
cost_centre_addTip=["",spacer+"This option allows all members of the group to add records to the 'Cost Centre:' table. A member who adds a record to the table becomes the 'owner' of that record."];

cost_centre_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Cost Centre:' table."];
cost_centre_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Cost Centre:' table."];
cost_centre_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Cost Centre:' table."];
cost_centre_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Cost Centre:' table."];

cost_centre_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Cost Centre:' table."];
cost_centre_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Cost Centre:' table."];
cost_centre_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Cost Centre:' table."];
cost_centre_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Cost Centre:' table, regardless of their owner."];

cost_centre_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Cost Centre:' table."];
cost_centre_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Cost Centre:' table."];
cost_centre_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Cost Centre:' table."];
cost_centre_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Cost Centre:' table."];

// dealer table
dealer_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dealer:' table. A member who adds a record to the table becomes the 'owner' of that record."];

dealer_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dealer:' table."];
dealer_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dealer:' table."];
dealer_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dealer:' table."];
dealer_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dealer:' table."];

dealer_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dealer:' table."];
dealer_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dealer:' table."];
dealer_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dealer:' table."];
dealer_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dealer:' table, regardless of their owner."];

dealer_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dealer:' table."];
dealer_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dealer:' table."];
dealer_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dealer:' table."];
dealer_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dealer:' table."];

// dealer_type table
dealer_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dealer Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

dealer_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dealer Type:' table."];
dealer_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dealer Type:' table."];
dealer_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dealer Type:' table."];
dealer_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dealer Type:' table."];

dealer_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dealer Type:' table."];
dealer_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dealer Type:' table."];
dealer_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dealer Type:' table."];
dealer_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dealer Type:' table, regardless of their owner."];

dealer_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dealer Type:' table."];
dealer_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dealer Type:' table."];
dealer_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dealer Type:' table."];
dealer_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dealer Type:' table."];

// tyre_log_sheet table
tyre_log_sheet_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tyre Data:' table. A member who adds a record to the table becomes the 'owner' of that record."];

tyre_log_sheet_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tyre Data:' table."];
tyre_log_sheet_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tyre Data:' table."];
tyre_log_sheet_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tyre Data:' table."];
tyre_log_sheet_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tyre Data:' table."];

tyre_log_sheet_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tyre Data:' table."];
tyre_log_sheet_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tyre Data:' table."];
tyre_log_sheet_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tyre Data:' table."];
tyre_log_sheet_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tyre Data:' table, regardless of their owner."];

tyre_log_sheet_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tyre Data:' table."];
tyre_log_sheet_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tyre Data:' table."];
tyre_log_sheet_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tyre Data:' table."];
tyre_log_sheet_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tyre Data:' table."];

// vehicle_daily_check_list table
vehicle_daily_check_list_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle Daily Check List:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_daily_check_list_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle Daily Check List:' table."];

vehicle_daily_check_list_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle Daily Check List:' table, regardless of their owner."];

vehicle_daily_check_list_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle Daily Check List:' table."];
vehicle_daily_check_list_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle Daily Check List:' table."];

// auditor table
auditor_addTip=["",spacer+"This option allows all members of the group to add records to the 'Auditor:' table. A member who adds a record to the table becomes the 'owner' of that record."];

auditor_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Auditor:' table."];
auditor_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Auditor:' table."];
auditor_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Auditor:' table."];
auditor_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Auditor:' table."];

auditor_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Auditor:' table."];
auditor_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Auditor:' table."];
auditor_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Auditor:' table."];
auditor_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Auditor:' table, regardless of their owner."];

auditor_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Auditor:' table."];
auditor_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Auditor:' table."];
auditor_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Auditor:' table."];
auditor_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Auditor:' table."];

// parts table
parts_addTip=["",spacer+"This option allows all members of the group to add records to the 'Parts:' table. A member who adds a record to the table becomes the 'owner' of that record."];

parts_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Parts:' table."];
parts_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Parts:' table."];
parts_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Parts:' table."];
parts_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Parts:' table."];

parts_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Parts:' table."];
parts_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Parts:' table."];
parts_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Parts:' table."];
parts_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Parts:' table, regardless of their owner."];

parts_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Parts:' table."];
parts_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Parts:' table."];
parts_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Parts:' table."];
parts_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Parts:' table."];

// parts_type table
parts_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Part Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

parts_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Part Type:' table."];
parts_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Part Type:' table."];
parts_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Part Type:' table."];
parts_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Part Type:' table."];

parts_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Part Type:' table."];
parts_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Part Type:' table."];
parts_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Part Type:' table."];
parts_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Part Type:' table, regardless of their owner."];

parts_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Part Type:' table."];
parts_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Part Type:' table."];
parts_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Part Type:' table."];
parts_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Part Type:' table."];

// breakdown_services table
breakdown_services_addTip=["",spacer+"This option allows all members of the group to add records to the 'Breakdown Services:' table. A member who adds a record to the table becomes the 'owner' of that record."];

breakdown_services_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Breakdown Services:' table."];
breakdown_services_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Breakdown Services:' table."];
breakdown_services_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Breakdown Services:' table."];
breakdown_services_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Breakdown Services:' table."];

breakdown_services_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Breakdown Services:' table."];
breakdown_services_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Breakdown Services:' table."];
breakdown_services_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Breakdown Services:' table."];
breakdown_services_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Breakdown Services:' table, regardless of their owner."];

breakdown_services_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Breakdown Services:' table."];
breakdown_services_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Breakdown Services:' table."];
breakdown_services_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Breakdown Services:' table."];
breakdown_services_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Breakdown Services:' table."];

// modification_to_vehicle table
modification_to_vehicle_addTip=["",spacer+"This option allows all members of the group to add records to the 'Modification to Vehicle:' table. A member who adds a record to the table becomes the 'owner' of that record."];

modification_to_vehicle_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Modification to Vehicle:' table."];
modification_to_vehicle_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Modification to Vehicle:' table."];
modification_to_vehicle_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Modification to Vehicle:' table."];
modification_to_vehicle_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Modification to Vehicle:' table."];

modification_to_vehicle_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Modification to Vehicle:' table."];
modification_to_vehicle_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Modification to Vehicle:' table."];
modification_to_vehicle_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Modification to Vehicle:' table."];
modification_to_vehicle_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Modification to Vehicle:' table, regardless of their owner."];

modification_to_vehicle_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Modification to Vehicle:' table."];
modification_to_vehicle_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Modification to Vehicle:' table."];
modification_to_vehicle_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Modification to Vehicle:' table."];
modification_to_vehicle_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Modification to Vehicle:' table."];

// vehicle_handing_over_checklist table
vehicle_handing_over_checklist_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle Handing Over Checklist:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_handing_over_checklist_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle Handing Over Checklist:' table."];

vehicle_handing_over_checklist_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle Handing Over Checklist:' table, regardless of their owner."];

vehicle_handing_over_checklist_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle Handing Over Checklist:' table."];
vehicle_handing_over_checklist_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle Handing Over Checklist:' table."];

// vehicle_return_check_list table
vehicle_return_check_list_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle Return Check List:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_return_check_list_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle Return Check List:' table."];

vehicle_return_check_list_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle Return Check List:' table, regardless of their owner."];

vehicle_return_check_list_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle Return Check List:' table."];
vehicle_return_check_list_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle Return Check List:' table."];

// indicates_repair_damages_found_list table
indicates_repair_damages_found_list_addTip=["",spacer+"This option allows all members of the group to add records to the 'Indicates Repairs & Damages Found List:' table. A member who adds a record to the table becomes the 'owner' of that record."];

indicates_repair_damages_found_list_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Indicates Repairs & Damages Found List:' table."];

indicates_repair_damages_found_list_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Indicates Repairs & Damages Found List:' table, regardless of their owner."];

indicates_repair_damages_found_list_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Indicates Repairs & Damages Found List:' table."];
indicates_repair_damages_found_list_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Indicates Repairs & Damages Found List:' table."];

// forms table
forms_addTip=["",spacer+"This option allows all members of the group to add records to the 'Forms:' table. A member who adds a record to the table becomes the 'owner' of that record."];

forms_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Forms:' table."];
forms_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Forms:' table."];
forms_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Forms:' table."];
forms_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Forms:' table."];

forms_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Forms:' table."];
forms_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Forms:' table."];
forms_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Forms:' table."];
forms_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Forms:' table, regardless of their owner."];

forms_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Forms:' table."];
forms_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Forms:' table."];
forms_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Forms:' table."];
forms_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Forms:' table."];

// identification_of_defects table
identification_of_defects_addTip=["",spacer+"This option allows all members of the group to add records to the 'Identification Of Defects:' table. A member who adds a record to the table becomes the 'owner' of that record."];

identification_of_defects_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Identification Of Defects:' table."];
identification_of_defects_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Identification Of Defects:' table."];
identification_of_defects_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Identification Of Defects:' table."];
identification_of_defects_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Identification Of Defects:' table."];

identification_of_defects_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Identification Of Defects:' table."];
identification_of_defects_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Identification Of Defects:' table."];
identification_of_defects_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Identification Of Defects:' table."];
identification_of_defects_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Identification Of Defects:' table, regardless of their owner."];

identification_of_defects_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Identification Of Defects:' table."];
identification_of_defects_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Identification Of Defects:' table."];
identification_of_defects_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Identification Of Defects:' table."];
identification_of_defects_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Identification Of Defects:' table."];

// gate_security table
gate_security_addTip=["",spacer+"This option allows all members of the group to add records to the 'Gate Security:' table. A member who adds a record to the table becomes the 'owner' of that record."];

gate_security_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Gate Security:' table."];
gate_security_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Gate Security:' table."];
gate_security_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Gate Security:' table."];
gate_security_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Gate Security:' table."];

gate_security_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Gate Security:' table."];
gate_security_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Gate Security:' table."];
gate_security_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Gate Security:' table."];
gate_security_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Gate Security:' table, regardless of their owner."];

gate_security_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Gate Security:' table."];
gate_security_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Gate Security:' table."];
gate_security_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Gate Security:' table."];
gate_security_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Gate Security:' table."];

// reception table
reception_addTip=["",spacer+"This option allows all members of the group to add records to the 'Reception:' table. A member who adds a record to the table becomes the 'owner' of that record."];

reception_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Reception:' table."];
reception_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Reception:' table."];
reception_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Reception:' table."];
reception_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Reception:' table."];

reception_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Reception:' table."];
reception_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Reception:' table."];
reception_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Reception:' table."];
reception_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Reception:' table, regardless of their owner."];

reception_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Reception:' table."];
reception_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Reception:' table."];
reception_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Reception:' table."];
reception_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Reception:' table."];

// inspection_bay table
inspection_bay_addTip=["",spacer+"This option allows all members of the group to add records to the 'Inspection Bay:' table. A member who adds a record to the table becomes the 'owner' of that record."];

inspection_bay_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Inspection Bay:' table."];
inspection_bay_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Inspection Bay:' table."];
inspection_bay_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Inspection Bay:' table."];
inspection_bay_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Inspection Bay:' table."];

inspection_bay_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Inspection Bay:' table."];
inspection_bay_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Inspection Bay:' table."];
inspection_bay_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Inspection Bay:' table."];
inspection_bay_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Inspection Bay:' table, regardless of their owner."];

inspection_bay_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Inspection Bay:' table."];
inspection_bay_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Inspection Bay:' table."];
inspection_bay_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Inspection Bay:' table."];
inspection_bay_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Inspection Bay:' table."];

// work_allocation table
work_allocation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Work Allocation:' table. A member who adds a record to the table becomes the 'owner' of that record."];

work_allocation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Work Allocation:' table."];
work_allocation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Work Allocation:' table."];
work_allocation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Work Allocation:' table."];
work_allocation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Work Allocation:' table."];

work_allocation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Work Allocation:' table."];
work_allocation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Work Allocation:' table."];
work_allocation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Work Allocation:' table."];
work_allocation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Work Allocation:' table, regardless of their owner."];

work_allocation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Work Allocation:' table."];
work_allocation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Work Allocation:' table."];
work_allocation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Work Allocation:' table."];
work_allocation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Work Allocation:' table."];

// internal_repairs_mechanical table
internal_repairs_mechanical_addTip=["",spacer+"This option allows all members of the group to add records to the 'Internal Repairs Mechanical:' table. A member who adds a record to the table becomes the 'owner' of that record."];

internal_repairs_mechanical_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Internal Repairs Mechanical:' table."];

internal_repairs_mechanical_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Internal Repairs Mechanical:' table, regardless of their owner."];

internal_repairs_mechanical_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Internal Repairs Mechanical:' table."];
internal_repairs_mechanical_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Internal Repairs Mechanical:' table."];

// external_repairs_mechanical table
external_repairs_mechanical_addTip=["",spacer+"This option allows all members of the group to add records to the 'External Repairs Mechanical:' table. A member who adds a record to the table becomes the 'owner' of that record."];

external_repairs_mechanical_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'External Repairs Mechanical:' table."];

external_repairs_mechanical_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'External Repairs Mechanical:' table, regardless of their owner."];

external_repairs_mechanical_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'External Repairs Mechanical:' table."];
external_repairs_mechanical_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'External Repairs Mechanical:' table."];

// internal_repairs_body table
internal_repairs_body_addTip=["",spacer+"This option allows all members of the group to add records to the 'Internal Repairs Body:' table. A member who adds a record to the table becomes the 'owner' of that record."];

internal_repairs_body_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Internal Repairs Body:' table."];
internal_repairs_body_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Internal Repairs Body:' table."];
internal_repairs_body_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Internal Repairs Body:' table."];
internal_repairs_body_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Internal Repairs Body:' table."];

internal_repairs_body_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Internal Repairs Body:' table."];
internal_repairs_body_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Internal Repairs Body:' table."];
internal_repairs_body_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Internal Repairs Body:' table."];
internal_repairs_body_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Internal Repairs Body:' table, regardless of their owner."];

internal_repairs_body_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Internal Repairs Body:' table."];
internal_repairs_body_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Internal Repairs Body:' table."];
internal_repairs_body_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Internal Repairs Body:' table."];
internal_repairs_body_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Internal Repairs Body:' table."];

// external_repairs_body table
external_repairs_body_addTip=["",spacer+"This option allows all members of the group to add records to the 'External Repairs Body:' table. A member who adds a record to the table becomes the 'owner' of that record."];

external_repairs_body_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'External Repairs Body:' table."];
external_repairs_body_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'External Repairs Body:' table."];
external_repairs_body_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'External Repairs Body:' table."];
external_repairs_body_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'External Repairs Body:' table."];

external_repairs_body_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'External Repairs Body:' table."];
external_repairs_body_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'External Repairs Body:' table."];
external_repairs_body_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'External Repairs Body:' table."];
external_repairs_body_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'External Repairs Body:' table, regardless of their owner."];

external_repairs_body_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'External Repairs Body:' table."];
external_repairs_body_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'External Repairs Body:' table."];
external_repairs_body_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'External Repairs Body:' table."];
external_repairs_body_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'External Repairs Body:' table."];

// ordering_of_spares_for_internal_repairs table
ordering_of_spares_for_internal_repairs_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ordering Of Spares For Internal Repairs:' table. A member who adds a record to the table becomes the 'owner' of that record."];

ordering_of_spares_for_internal_repairs_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ordering Of Spares For Internal Repairs:' table."];

ordering_of_spares_for_internal_repairs_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ordering Of Spares For Internal Repairs:' table, regardless of their owner."];

ordering_of_spares_for_internal_repairs_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ordering Of Spares For Internal Repairs:' table."];
ordering_of_spares_for_internal_repairs_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ordering Of Spares For Internal Repairs:' table."];

// collection_of_repaired_vehicles table
collection_of_repaired_vehicles_addTip=["",spacer+"This option allows all members of the group to add records to the 'Collection Of Repaired Vehicles:' table. A member who adds a record to the table becomes the 'owner' of that record."];

collection_of_repaired_vehicles_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Collection Of Repaired Vehicles:' table."];

collection_of_repaired_vehicles_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Collection Of Repaired Vehicles:' table, regardless of their owner."];

collection_of_repaired_vehicles_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Collection Of Repaired Vehicles:' table."];
collection_of_repaired_vehicles_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Collection Of Repaired Vehicles:' table."];

// withdrawal_vehicle_from_operation table
withdrawal_vehicle_from_operation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Withdrawal Of Vehicle:' table. A member who adds a record to the table becomes the 'owner' of that record."];

withdrawal_vehicle_from_operation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Withdrawal Of Vehicle:' table."];

withdrawal_vehicle_from_operation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Withdrawal Of Vehicle:' table, regardless of their owner."];

withdrawal_vehicle_from_operation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Withdrawal Of Vehicle:' table."];
withdrawal_vehicle_from_operation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Withdrawal Of Vehicle:' table."];

// costing table
costing_addTip=["",spacer+"This option allows all members of the group to add records to the 'Costing:' table. A member who adds a record to the table becomes the 'owner' of that record."];

costing_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Costing:' table."];
costing_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Costing:' table."];
costing_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Costing:' table."];
costing_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Costing:' table."];

costing_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Costing:' table."];
costing_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Costing:' table."];
costing_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Costing:' table."];
costing_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Costing:' table, regardless of their owner."];

costing_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Costing:' table."];
costing_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Costing:' table."];
costing_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Costing:' table."];
costing_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Costing:' table."];

// billing table
billing_addTip=["",spacer+"This option allows all members of the group to add records to the 'Billing:' table. A member who adds a record to the table becomes the 'owner' of that record."];

billing_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Billing:' table."];
billing_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Billing:' table."];
billing_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Billing:' table."];
billing_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Billing:' table."];

billing_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Billing:' table."];
billing_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Billing:' table."];
billing_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Billing:' table."];
billing_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Billing:' table, regardless of their owner."];

billing_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Billing:' table."];
billing_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Billing:' table."];
billing_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Billing:' table."];
billing_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Billing:' table."];

// general_control_measures table
general_control_measures_addTip=["",spacer+"This option allows all members of the group to add records to the 'General Control Measures:' table. A member who adds a record to the table becomes the 'owner' of that record."];

general_control_measures_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'General Control Measures:' table."];
general_control_measures_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'General Control Measures:' table."];
general_control_measures_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'General Control Measures:' table."];
general_control_measures_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'General Control Measures:' table."];

general_control_measures_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'General Control Measures:' table."];
general_control_measures_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'General Control Measures:' table."];
general_control_measures_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'General Control Measures:' table."];
general_control_measures_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'General Control Measures:' table, regardless of their owner."];

general_control_measures_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'General Control Measures:' table."];
general_control_measures_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'General Control Measures:' table."];
general_control_measures_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'General Control Measures:' table."];
general_control_measures_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'General Control Measures:' table."];

// movement_of_personnel_in_government_garage_and_workshops table
movement_of_personnel_in_government_garage_and_workshops_addTip=["",spacer+"This option allows all members of the group to add records to the 'Movement Of Personnel In Government Garage And Workshops:' table. A member who adds a record to the table becomes the 'owner' of that record."];

movement_of_personnel_in_government_garage_and_workshops_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Movement Of Personnel In Government Garage And Workshops:' table."];

movement_of_personnel_in_government_garage_and_workshops_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Movement Of Personnel In Government Garage And Workshops:' table, regardless of their owner."];

movement_of_personnel_in_government_garage_and_workshops_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Movement Of Personnel In Government Garage And Workshops:' table."];
movement_of_personnel_in_government_garage_and_workshops_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Movement Of Personnel In Government Garage And Workshops:' table."];

// service_provider table
service_provider_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Provider :' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_provider_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Provider :' table."];
service_provider_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Provider :' table."];
service_provider_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Provider :' table."];
service_provider_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Provider :' table."];

service_provider_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Provider :' table."];
service_provider_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Provider :' table."];
service_provider_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Provider :' table."];
service_provider_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Provider :' table, regardless of their owner."];

service_provider_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Provider :' table."];
service_provider_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Provider :' table."];
service_provider_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Provider :' table."];
service_provider_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Provider :' table."];

// service_provider_type table
service_provider_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Provider Type:' table. A member who adds a record to the table becomes the 'owner' of that record."];

service_provider_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Provider Type:' table."];
service_provider_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Provider Type:' table."];
service_provider_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Provider Type:' table."];
service_provider_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Provider Type:' table."];

service_provider_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Provider Type:' table."];
service_provider_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Provider Type:' table."];
service_provider_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Provider Type:' table."];
service_provider_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Provider Type:' table, regardless of their owner."];

service_provider_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Provider Type:' table."];
service_provider_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Provider Type:' table."];
service_provider_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Provider Type:' table."];
service_provider_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Provider Type:' table."];

// vehicle_annual_inspection table
vehicle_annual_inspection_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vehicle Annual Inspection:' table. A member who adds a record to the table becomes the 'owner' of that record."];

vehicle_annual_inspection_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vehicle Annual Inspection:' table."];

vehicle_annual_inspection_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vehicle Annual Inspection:' table, regardless of their owner."];

vehicle_annual_inspection_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vehicle Annual Inspection:' table."];
vehicle_annual_inspection_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vehicle Annual Inspection:' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
