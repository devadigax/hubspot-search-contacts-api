<!DOCTYPE html>
<html>

<head>
    <title>Search Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <!-- Jumbotron Header -->
        <div class="card my-4">
            <h5 class="card-header">Search Contacts</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchFirstName" name="searchFirstName" placeholder="FirstName">
                    <input type="text" class="form-control" id="searchLastName" name="searchLastName" placeholder="LastName">
                    <input type="text" class="form-control" id="searchCompany" name="searchCompany" placeholder="Company">
                    <span class="input-group-btn">
                        <button id="searchButton" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </div>
        </div>

        <!-- Table to display search results -->
        <table class="table table-secondary" id="searchResultsTable">
            <thead>
                <tr>
                    <th>Contact ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Last Modified Date</th>
                    <th>Create Date</th>
                </tr>
            </thead>
            <tbody id="searchResults">
                <!-- The search results will be displayed here -->
            </tbody>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to handle contact search
        function searchContacts(searchTerm, propertyName) {
            // Send the search term to the PHP script for processing
            $.ajax({
                url: "search_contacts.php", // PHP script to handle the search
                type: "POST",
                data: {
                    searchTerm: searchTerm,
                    propertyName: propertyName
                },
                dataType: "json",
                success: function(response) {
                    console.log("Response from API:", response); // Log the response for debugging

                    const resultsTable = $("#searchResultsTable tbody");
                    resultsTable.empty();

                    if (response && response.results && response.results.length > 0) {
                        response.results.forEach(contact => {
                            const properties = contact.properties;

                            // Create a new table row for each contact
                            const row = $("<tr>");

                            // Add table cells for each contact property
                            row.append($(`<td>${properties.hs_object_id || 'Not Provided'}</td>`));
                            row.append($(`<td>${properties.firstname || 'Not Provided'}</td>`));
                            row.append($(`<td>${properties.lastname || 'Not Provided'}</td>`));
                            row.append($(`<td><a href='mailto:${properties.email}'>${properties.email || 'Not Provided'}</a></td>`));
                            row.append($(`<td>${properties.lastmodifieddate || 'Not Provided'}</td>`));
                            row.append($(`<td>${properties.createdate || 'Not Provided'}</td>`));
                            
                            // Append the new row to the table
                            resultsTable.append(row);
                        });
                    } else {
                        // If no results found, display a row with a message
                        resultsTable.append(`
                        <tr>
                            <td colspan="6">No results found.</td>
                        </tr>
                    `);
                    }
                },
                error: function(error) {
                    console.log("Error searching contacts:", error);
                    const resultsTable = $("#searchResultsTable tbody");
                    resultsTable.empty();
                    resultsTable.append("<tr><td colspan='6'>Error retrieving data. Please try again later.</td></tr>");
                }
            });
        }

        // Handle form submission for all three search boxes
        $("#searchButton").click(function() {
            const companySearchTerm = $("#searchCompany").val();
            const firstNameSearchTerm = $("#searchFirstName").val();
            const lastNameSearchTerm = $("#searchLastName").val();

            if (companySearchTerm !== "") {
                searchContacts(companySearchTerm, "company");
            } else if (firstNameSearchTerm !== "") {
                searchContacts(firstNameSearchTerm, "firstname");
            } else if (lastNameSearchTerm !== "") {
                searchContacts(lastNameSearchTerm, "lastname");
            } else {
                alert("Please enter at least one search term.");
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>