<style>
    tr,td{
        border: 1px solid red;
    }
</style>
<table>
    <tr>
        <td>PR ID</td>
        <td>PR Type</td>
        <td>Category</td>
        <td>Item Name</td>
        <td>Item Code</td>
        <td>Quantity</td>
    </tr>
    @foreach ($results as $result => $res)
        @foreach ($res as $r)
        <tr>
            <td>{{$r->pr_id}}</td>
            <td>{{$r->pr_type}}</td>
            <td>{{$r->category}}</td>
            <td>{{$r->item_name}}</td>
            <td>{{$r->item_code}}</td>
            <td>{{$r->quantity}}</td>
        </tr>
    @endforeach
    @endforeach
</table>