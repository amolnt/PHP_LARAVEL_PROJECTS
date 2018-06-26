@extends('master.master')
	@section('pageContent')
		<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Service Call History</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Request Date &amp; Time</th>
                          <th>Service Tag</th>
                          <th>Invoice No.</th>
                          <th>Invoice Date</th>
                          <th>Invoice Amount</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>2011/04/25</td>
                          <td>SR-25643</td>
                          <td>SI-4567</td>
                          <td>2011/04/25</td>
                          <td>Rs.700</td>
                          <td>Outstanding</td>
                        </tr>			
                        <tr>
                          <td>2011/04/25</td>
                          <td>SR-25643</td>
                          <td>SI-4568</td>
                          <td>2011/01/25</td>
                          <td>Rs.1200</td>
                          <td>Non AMC - Paid</td>
                        </tr>
                        <tr>
                          <td>2011/04/25</td>
                          <td>SR-25643</td>
                          <td>SI-4569</td>
                          <td>2011/01/25</td>
                          <td>Rs.1500</td>
                          <td>AMC - Paid</td>
                        </tr>
                      </tbody>
                    </table>
                          
                  </div>
              </div>
            </div>
          </div>
        </div>
	@endsection