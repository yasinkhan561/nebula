<?php 
    $firstToolName = App\Models\Tool::find(1)->name; 
    $secondToolName = App\Models\Tool::find(2)->name;
   ?>

<header id="navbar">
    <div id="navbar-container" class="boxed">
        <div class="navbar-content">
            <ul class="nav navbar-top-links navbar-left">                          
                <li >
                    <a  href="{{ route('websites.index') }}">
                       <strong>Tested Websites </strong>
                    </a>
                </li>
                <li >
                    <a  href="{{ route('pages.index') }}">
                    <strong> Pages </strong>
                    </a>
                </li>
             
                <li>
                    <a  href="{{ route('violations.index') }}">
                    <strong>{{$secondToolName}}</strong>
                    </a>
                </li>
                <li>
                    <a  href="{{ route('issues.index') }}">
                    <strong> {{$firstToolName}}</strong>
                    </a>
                </li>
               
                <li>
                    <a  href="{{ route('statuses.index') }}">
                       <strong> Status Management</strong>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong> Import</strong> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a  href="{{ route('issues.import') }}">
                            <strong> {{$secondToolName}} Results </strong>
                            </a>
                        </li>
                        <li>
                            <a  href="{{ route('violations.import') }}">
                            <strong>{{$firstToolName}} Results</strong>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
    
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>
