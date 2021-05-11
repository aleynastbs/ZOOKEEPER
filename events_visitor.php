<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Zoo Sample Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="employee.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Zoo</span>
            </div>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav navbar-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events_visitor.html"><strong>Events</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shops.html">Shops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Animals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="membership.php">Membership</a>
                </ul>
            </div>
        </nav>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        
        <h3 style="text-align:center">Events</h3>
        <table style="width:45%" class="center">
            <tr>
                <th style="text-align:center">Event ID</th>
                <th style="text-align:center">Event Name</th>
                <th style="text-align:center">Event Date</th>
                <td></td>
              </tr>
            <tr>
                <td style="text-align:center">1</td>
                <td style="text-align:center">Group Tour A</td>
                <td style="text-align:center">/TBA</td>
                <th style="text-align:center" scope="row" ><a href="comments.html" class="btn btn-outline-success btn-sm" role="button">Select</a></th>
            </tr>
            <tr>
                <td style="text-align:center">2</td>
                <td style="text-align:center">Educational Program B</td>
                <td style="text-align:center">/TBA</td>
                <th style="text-align:center" scope="row" ><a href="#link" class="btn btn-outline-success btn-sm" role="button">Select</a></th>
            </tr>
            <tr>
                <td style="text-align:center">3</td>
                <td style="text-align:center">Conservation Organization C</td>
                <td style="text-align:center">/TBA</td>
                <th style="text-align:center" scope="row" ><a href="#link" class="btn btn-outline-success btn-sm" role="button">Select</a></th>
            </tr>
              <tr>
                <td style="text-align:center">4</td>
                <td style="text-align:center">Event D</td>
                <td style="text-align:center">/TBA</td>
                <th style="text-align:center" scope="row" ><a href="#link" class="btn btn-outline-success btn-sm" role="button">Select</a></th>
            </tr>
            <tr>
                <td style="text-align:center">5</td>
                <td style="text-align:center">Event E</td>
                <td style="text-align:center">/TBA</td>
                <th style="text-align:center" scope="row" ><a href="#link" class="btn btn-outline-success btn-sm" role="button">Select</a></th>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="text-center">
        <div class="item">
              <select>
                <option value="1">All Event Types</option>
                <option value="2">Group Tour</option>
                <option value="3">Educational Program</option>
                <option value="4">Conservation Organization</option>
              </select>
          </div>
          <div class="item">
            <select>
              <option value="5">Show All</option>
              <option value="6">Show Attended</option>
            </select>
        </div>
        </div>
        <div class="text-center">
          <a href="events_visitor.html" class="btn btn-outline-success btn-lg" role="button">List</a>
        </div> 
    </body>
</html>