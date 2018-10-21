<html>
    <head>
        <title>Employees</title>
        <!-- ======================== IMPORTS [ IMPORTSTANTS :D ]========================= -->
        <script src = "../JS/jquery-1.9.1.min.js"></script>
        <script src = "../JS/jquery-ui-1.10.2.min.js"></script>
        <script src = "../JS/bootstrap.min.js"></script>
        <script src = "../JS/employees.js"></script>
        <link rel = "shortcut icon" href = "../CSS/images/IIS%20logos/iis0.jpg" />
        <link rel = "stylesheet" href = "../CSS/includes_all_css_files.css" />
    </head>
    <body>
        <div id = "employees_main_div_container" class = "container">
            <h2>Employees</h2>
            <div id = "employees_actions_div">
                <ul id = "employees_actions_ul">
                    <li></li>
                    <li><accr title = "add new employee"><img src = "../CSS/images/add_employee_icon.png" id = "add_employees_image"/></accr></li>
                    <li><accr title = "show fired employees"><img src = "../CSS/images/show_icon.png" id = "show_fired_employees_image" /></accr></li>
                </ul>
                <div id = "employees_category_div">
                    <span></span>
                    <span style='font-weight:bold'>CATEGORIES:</span>
                    <button id = "cashiers_category_button">cashiers</button>
                    <button id = "packers_category_button">packers</button>
                    <button id = "porters_category_button">porters</button>
                </div>
            </div><!-- =============== employees actions div ends =================== -->
            <div id = "display_employees_div">

                <table id = "cashiers_table" class = "table table-striped table-bordered table-condensed">
                    <caption>CASHIERS</caption>
                    <tr>
                        <th colspan="5">
                            <img src = "../CSS/images/search_icon1.png" />
                            <input type = "text" id = "search_cashier_input_field" class = "search-query" placeholder = "Search employee here"/>
                        </th>
                    </tr>
                    <tr>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>BIRTHDAY</th>
                        <th>ADDRESS</th>
                        <th>CONTACT NUMBER</th>
                    </tr>
                    <tbody id = "display_cashier_employees_table"></tbody>
                </table>
                <table id = "packers_table" class = "table table-striped table-bordered table-condensed">
                    <caption>PACKERS</caption>
                    <tr>
                        <th colspan="5">
                            <img src = "../CSS/images/search_icon1.png" />
                            <input type = "text" id = "search_packer_input_field" class = "search-query" placeholder = "Search employee here"/>
                        </th>
                    </tr>
                    <tr>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>BIRTHDAY</th>
                        <th>ADDRESS</th>
                        <th>CONTACT NUMBER</th>
                    </tr>
                    <tbody id = "display_packer_employees_table"></tbody>
                </table>
                <table id = "porters_table" class = "table table-striped table-bordered table-condensed">
                    <caption>PORTERS</caption>
                    <tr>
                        <th colspan="5">
                            <img src = "../CSS/images/search_icon1.png" />
                            <input type = "text" id = "search_porter_input_field" class = "search-query" placeholder = "Search employee here"/>
                        </th>
                    </tr>
                    <tr>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>BIRTHDAY</th>
                        <th>ADDRESS</th>
                        <th>CONTACT NUMBER</th>
                    </tr>
                    <tbody id = "display_porter_employees_table"></tbody>
                </table>
            </div><!-- ================ display employees div container ends ==================== -->

            <div id = "add_employees_div">
                <span id = "add_employees_close_span" title = "close"><img src = "../CSS/images/close_icon.png"></span>
                <form id = "add_employees_form">
                    <h4>EMPLOYEE'S REGISTRATION FORM</h4>
                    <dl id = "add_employees_dl">
                        <dt>Last name:</dt>
                            <dd id = "lastname_dd"><input type = "text" name = "lastname" id = "lastname"/></dd>
                        <dt>First name:</dt>
                            <dd id = "firstname_dd"><input type = "text" name = "firstname" id = "firstname" /></dd>
                        <dt>Genger:</dt>
                            <dd id = "gender_dd"><select name = "gender" id = "gender" class = "span2"><option>female</option><option>male</option></select></dd>
                        <dt>Birhtday:</dt>
                            <dd id = "birthday_dd">
                                <select name = "birthday_month" id = "birthday_month" class = "span1"></select>
                                <select name = "birthday_date" id = "birthday_date" class = "span1"></select>
                                <select name = "birthday_year" id = "birthday_year" class = "span2"></select>
                            </dd>
                        <dt>Address:</dt>
                            <dd id = "address_dd"><input type = "text" name = "address" id = "address" /></dd>
                        <dt>Contact number:</dt>
                            <dd id = "contact_number_dd"><input type = "text" name = "contact_number" id = "contact_number" /></dd>
                        <dt>Job type:</dt>
                            <dd><select name = "job_type" id = "job_type">
                                    <option>porter</option>
                                    <option>cashier</option>
                                    <option>packer</option>
                            </select></dd>

                        <div id = "add_account_for_cashier_div">
                            <h5>Create Cashier's Account:</h5>
                            <dl id = "add_account_for_cashier_d l">
                                <dt>Username:</dt>
                                    <dd id = "username_dd"><input type = "text" name = "username" id = "username" /></dd>
                                <dt>Password:</dt>
                                    <dd id = "password_dd"><input type = "password" name = "password" id = "password"></dd>
                                <dt>Password Confirmation:</dt>
                                    <dd id = "password_confirmation_dd"><input type = "password" name = "password_confirmation" id = "password_confirmation" /></dd>
                            </dl><!-- ========== add_account_for_cashier_dl ends ==============-->
                        </div><!-- ============ add account for cashier div ends ================= -->
                    </dl><!-- ============= add employees dl ends -->
                    <p class = "alert alert-error" id = "add_employee_warning">
                        Please fill-up all fields and check the inputted employee's data!
                    </p>
                    <p class = "alert alert-block" id = "employee_exist_warning"></p>
                    <input type = "reset" value = "reset" class = "btn btn-danger" />
                </form><!-- ============= Add employees form ends ================ -->
                <p id = "employee_added_successfully_p">New employee was added successfully!</p>
                <button id = "add_employee_button" class = "btn btn-primary">&nbsp;add&nbsp;</button>
                <button id = "save_employee_button" class = "btn btn-primary">&nbsp;save&nbsp;</button>
            </div><!-- ==================== add employees div ends ========================= -->

            <div id = "fired_employees_div">
                <span id = "close_fired_employees_div" title = "close"><img src="../CSS/images/close_icon.png"></span>
                <h3>FIRED EMPLOYEES</h3>
                <div id = "search_fired_employee_div">
                    <img src = "../CSS/images/search_icon1.png" />
                    <input type = "text" id = "search_fired_employee_input" class = "search-query" placeholder = "Search fired employee here" />
                </div>
                <table id = "fired_employees_table" class = "table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>INFORMATIONS</th>
                            <th>DATE FIRED</th>
                            <th>REASON</th>
                            </tr>
                    </thead>
                    <tbody id = "display_fired_employees_table"></tbody>
                </table>

            </div><!-- ========== fired enployees div ends =========== -->

        </div><!-- ================== employees main div container ends ==================== -->

        <!-- ======================== HIDDEN FOR POP-UPS / OVERLAYS AND OTHERS =========================-->
        <div id = "overlay_div_container"></div>
        <div id = "action_options_div">
            <span id = "close_action_options_span" title = "close" ><img src="../CSS/images/close_icon.png"></span>
            ACTIONS:
            <div>
                <button class = "btn btn-primary" id = "edit_employees_info_button"><li class = "icon-edit"></li>update info</button>
                <button class = "btn btn-danger" id = "fire_employee_button"><li class = "icon-remove"></li>fire employee</button>
            </div>
        </div><!--============ action_options_div ends ============== -->
        <div id = "fire_employee_confirmation_div">
            Sure to fire the selected employee?
        </div><!-- =========== fire_employee_confirmation div ends ==============-->
        <div id = "fire_employee_remarks_div">
            <span id = "close_remarks_div_span" title = "close"><img src="../CSS/images/close_icon.png"></span>
            <h3>FIRING EMPLOYEE</h3>
            <form id = "fire_employee_remarks_form">
                <dl>
                    <dt>
                        Employee Name:
                    </dt>
                        <dd id = "fire_employee_name"></dd>
                    <dt>Date fired:</dt>
                        <dd id = "date_fired"></dd>
                    <dt>FIRING REMARKS:</dt>
                        <dd><textarea id = "firing_remarks_textarea" name = "firing_remarks_textarea" placeholder = "Please leave a firing remarks here"></textarea></dd>
                </dl>
                <input type = "reset" class = "btn btn-danger" id = "cancel_firing_button" value = " cancel firing " />
            </form>
            <button class = "btn btn-primary" id = "submit_firing_remarks_button">submit remarks</button>
        </div>
        <input type = "hidden" id = "id" name = "id" />
    </body>
</html>
