@extends('master.master')
	@section('pageContent')
		<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Service Calls</h2>
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
                          <th>Location</th>
                          <th>Engineer</th>
                          <th>Serve Date &amp; Time</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                         @if(isset($tr))
                        <?php
                            echo $tr;
                        ?>
                        @endif

                        <!--tr>
                          <td>2011/04/25</td>
                          <td>SR-25643</td>
                          <td>Location - 1</td>
                          <td>--</td>
                          <td>2011/04/25</td>
                          <td>Open</td>
                        </tr>			
                        <tr>
                          <td>2011/04/25</td>
                          <td>SR-25643</td>
                          <td>Location - 2</td>
                          <td>Shamprasad</td>
                          <td>2011/01/25</td>
                          <td>Allocated</td>
                        </tr>
                        <tr>
                          <td>2011/04/25</td>
                          <td>SR-25643</td>
                          <td>Location - 3</td>
                          <td>Ramprasad</td>
                          <td>2011/01/25</td>
                          <td>Closed</td>
                        </tr-->
                      </tbody>
                    </table>
                          
                  </div>
              </div>
            </div>
          </div>
        </div>

        @if(isset($popup))
          <?php
            echo $popup;
          ?>
        @endif

	@endsection