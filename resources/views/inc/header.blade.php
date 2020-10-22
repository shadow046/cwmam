<div class="d-flex">
    <img class="p-2 align-self-end" src="/idsi.png" alt="idsi.png" style="width: auto; height: 120px;">
    <h2 class="p-2 align-self-end" style="color: #0d1a80; font-family: arial; font-weight: bold;">SERVICE CENTER STOCK INVENTORY MONITORING</h2>
    @auth
    <div class="p-2 ml-auto align-self-end d-flex" id="branchid" branchid="{{ auth()->user()->branch->id}}">
        <a href="{{route('change.password')}}">
            <div class="p-2 ml-auto" style="text-align: right;">
                    <p style="color: #0d1a80">{{ auth()->user()->name}}</p>
                    <p style="color: #0d1a80">{{ auth()->user()->branch->branch}}</p>
                    <p style="color: #0d1a80">{{Carbon\Carbon::now()->toDayDateTimeString()}}</p>
            </div>
        </a>
        <i class="fa fa-user-circle fa-5x p-2"></i>
    </div>
    @endauth
</div>