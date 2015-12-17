# API Documentation #
`#` stands for an ID integer.

| Password | HTTP | Resource | Result |
|----------|------|----------|--------|
| No | GET | index.php/api/requests/reviews/#/comments | Get all comments for specified product review |
| No | GET | index.php/api/requests/products/#/reviews | Get all reviews for specified product |
| No | GET | index.php/api/requests/products/# | Get a specific product |
| No | GET | index.php/api/requests/products | Get all products |
| No | GET | index.php/api/requests/users/#/collections | Get all collections for specified user |
| No | GET | index.php/api/requests/users/#/comments | Get all comments for specified user |
| No | GET | index.php/api/requests/users/#/reviews| Get all comments for specified user |
| No | GET | index.php/api/requests/users/# | Get a specific user |
| No | GET | index.php/api/requests/users | Get all users |
| No | GET | index.php/api/requests/reviews/#/comments | Get all comments for specified review |
| No | GET | index.php/api/requests/reviews/# | Get a specific review |
| No | GET | index.php/api/requests/reviews | Get all reviews |
| No | GET | index.php/api/requests/collections/# | Get a specific collection ("shelf") |

## Partially Implemented Queries ##
These queries only work as the admin account (ID 3) with username `admin` and password `1234` provided in the header as basic authentication. Provide the comment text in plain text in the request body in the key `text`.

| Password | HTTP | Resource | Result |
|----------|------|----------|--------|
| Yes | POST | index.php/api/requests/reviews/#/comments | Post a new comment on specified review's page |
| Yes | POST | index.php/api/requests/products/#/comments | Post a new comment on specified product's page |
| Yes | POST | index.php/api/requests/users/#/comments | Post a new comment on specified user's page |

# Unavailable Unimplemented or Partially Implemented Queries #
Everything below was planned or partially implemented but has been removed or commented out in the final release. `#` stands for an ID integer.

| Password | HTTP | Resource | Result |
|----------|------|----------|--------|
| Yes/Admin Only | POST | index.php/api/requests/products | Create a new product |
| Yes | POST | index.php/api/requests/products/#/reviews/ | Create a new review |
| Yes | PUT | index.php/api/requests/user/collections/#/products/# | Put a new product into own collection |
| Yes | DELETE| index.php/api/requests/user/collections/#/products/# | Remove product from specified own collection |
| Yes | DELETE| index.php/api/requests/user/collections/#/ | Clear specified own collection |
| Yes | DELETE| index.php/api/requests/user/collections | Clear all own collections |
| Yes | DELETE| index.php/api/requests/products/#/reviews/# | Remove own review from product |