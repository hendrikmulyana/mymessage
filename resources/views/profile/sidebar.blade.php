 <div class="panel panel-default">
     <div class="panel-heading"><b>Sidebar-Quick Links</b></div>
            <ul>
                <li>
                    <a href="{{ url('beranda') }}">
                        <img src="{{Config::get('app.url')}}/image/logo/beranda.png"
                        width="32" style="margin:5px"  />
                        <span style=" color: #000"><b>Beranda</b></span></a>
                </li>
                <li>
                    <a href="{{url('message')}}"> <img src="{{Config::get('app.url')}}/image/logo/message.png"
                                                         width="32" style="margin:5px"  />
                        <span style=" color: #000"><b>Messages</b></span></a>
                </li>
                <li>
                    <a href="{{url('job')}}"> <img src="{{Config::get('app.url')}}/image/logo/job.png"
                                                     width="32" style="margin:5px"  />
                        <span style=" color: #000"><b>Find Jobs</b></span></a>
                </li>
            </ul>
        </div>