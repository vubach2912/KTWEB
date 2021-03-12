<table class="table" id="trades-table">
    <tbody>
        <tr>
            <td>
                {{ $trade->quality }} - {{ $trade->item_type }}
                <br/>
                {{ $trade->name }}
                <br/>
                Notes: {{ $trade->note }}
            </td>
            <td style="text-align: center">
                <img src="{{ $trade->image }}" width="250px"/>
                <br/>
                {{ $trade->amount }} {{ $trade->amount_type }}
            </td>
        </tr>
    </tbody>
</table>


<style>
    td {
        line-height: 1.1;
        text-shadow: -1px -1px 0 rgba(0,0,0,.3);
        text-transform: uppercase;
    }

    #trades-table table {
        background-color: transparent;
    }

    #trades-table tr {
        border: 2px solid #323232;
    }

    #trades-table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }
</style>
