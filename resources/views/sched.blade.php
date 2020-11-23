<div>
    <p>&nbsp;</p>
    <table>
        <tbody>
            <tr style="height:14pt">
                <td width="707" colspan="2" valign="top" style="width:690pt;border-top:none;border:solid #d9d9d9 1.0pt;background:red;"></td>
            </tr>
            <tr style="height:50pt">
                <td width="707" colspan="2" valign="top" style="width:690pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p><img src="{{asset('idsi.png')}}" height="50"/></p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="707" colspan="2" valign="top" style="width:690pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Stock Request {{ $reqno }} has received and scheduled for delivery on {{$sched}}.</p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="165" style="width:143;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Requested Items Approve And For Delivery:</p>
                </td>
                <td width="542" style="width:546pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>
                        <span style="color:black">
                            <ul>
                                @foreach ($prepitem as $item)
                                    <li>{{ $item->item }} - "S/N: {{ $item->serial }}"</li>
                                @endforeach
                            </ul>
                        </span>
                    </p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="165" style="width:143;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Requested for:</p>
                </td>
                <td width="542" style="width:546pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>
                        <span style="color:black">
                           {{ $branch->branch }}
                        </span>
                    </p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="165" style="width:143;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Prepared by:</p>
                </td>
                <td width="542" style="width:546pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>
                        <span style="color:black">
                           {{auth()->user()->name}} {{auth()->user()->lastname}}
                        </span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>