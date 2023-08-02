<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Replace "YOUR_HUBSPOT_ACCESS_TOKEN" with your actual HubSpot access token
            $accessToken = "YOUR_HUBSPOT_ACCESS_TOKEN";
        
            // HubSpot API endpoint for searching contacts
            $hubspotUrl = "https://api.hubapi.com/crm/v3/objects/contacts/search";
        
            // Retrieve the search term and property name from the AJAX request
            $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';
            $propertyName = isset($_POST['propertyName']) ? $_POST['propertyName'] : '';
        
            // Set the search query based on the provided search term and property name
            $query = array(
                "filterGroups" => array(
                    array(
                        "filters" => array(
                            array(
                                "value" => $searchTerm,
                                "propertyName" => $propertyName,
                                "operator" => "EQ"
                            )
                        )
                    )
                )
            );
        
            // Convert the query data to JSON
            $queryJson = json_encode($query);
        
            // Create a new cURL resource
            $ch = curl_init($hubspotUrl);
        
            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $queryJson);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken, 'Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            // Execute cURL and get the response
            $response = curl_exec($ch);
        
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'Error making cURL request: ' . curl_error($ch);
            }
        
            // Close cURL resource
            curl_close($ch);
        
            // Return the response to AJAX
            echo $response;
        }
        ?>
        