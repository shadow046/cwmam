@guest
    <div><center><img class="p-2 align-self-end" src="/idsi.png" alt="idsi.png" style="width: auto; height: 150px;"></center></div>
    <div style="color: white; font-family: arial; font-weight: bold;background-color: #0d1a80"><h3 class="p-2 align-self-end"><center>CUSTOMER WARRANTY AND MA MONITORING SYSTEM</center></h3></div>
@endguest

@auth
    @if(auth()->user()->hasAnyrole('Administrator'))
        <div class="d-flex">
            <img class="p-2 align-self-end" src="/idsi.png" alt="idsi.png" style="width: auto; height: 90px;">
            <h3 class="p-2 align-self-end" style="color: #0d1a80; font-family: arial; font-weight: bold;">CUSTOMER WARRANTY AND MA MONITORING SYSTEM</h3>
            <div class="p-2 ml-auto align-self-end d-flex">
                <a href="#">
                    <div class="p-2 ml-auto" style="text-align: right;">
                            <p style="color: #0d1a80">{{auth()->user()->firstname}}{{auth()->user()->lastname}}</p>
                            <p style="color: #0d1a80">{{Carbon\Carbon::now()->toDayDateTimeString()}}</p>
                    </div>
                </a>
                <i class="fa fa-user-circle fa-4x p-2"></i>
            </div>
        </div>
    @endif
@endauth