# BBD-Testing-Infrastructure

#### Sample Feature File

```gherkin
Feature: Update an Invoice      
    Background:    
        Given a "users" table with the following information:           
            | reference     | first_name | last_name | status   |
            | Active User   | Des        | O'Leary   | active   |           
            | Inactive User | Noel       | O'Brien   | inactive |

        And an "items" table with the following information:           
            | reference | name   | price   |           
            | Item #1   | mobile | 1000.00 |           
            | Item #2   | laptop | 2500.00 | 
    
        And an "orders" table with the following information: 
            | reference  | user_reference  | price   |   
            | Order #1   | Active User     | 1000.00 |      
            | Order #2   | Active User     | 2500.00 | 
        
        And an "invoice" table with the following information:           
            | reference  | user_reference | order_reference | amount_paid |
            | Invoice #1 | Active User    | Order #1        | 1000.00     |
            | Invoice #2 | Active User    | Order #2        | 2500.00     |

    Scenario: Invoice details can be updated    
        When I add the following "users":
            | reference | first_name | last_name |
            | User # 3  | Chuck      | Norris    |           
            | User # 4  | Bruce      | Lee       |
        
        When I fill in the following inputs for "orders":
            | user_reference | amount_paid |
            | User # 3       | 900.00      |
            | User # 4       | 3020.00     |
           
        And I attempt to update the order
        Then the order should be updated
        And an audit entry should be created    
        
    Scenario: Order's amount paid must be a positive number
        When I fill in "amount_paid" with "-5.00" for "Invoice #2"
        And I attempt to update the invoice
        Then an error message "This must be greater than zero." should be shown under the "amount_paid" field        
```