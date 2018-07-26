// $(document).ready(function(){
//     $merchListsLabel = document.getElementById('merch-table-main');
//
//     $('#merchandise-new').on('submit', function(e){
//         e.preventDefault();
//
//         $.ajax({
//             type: 'POST',
//             url: '/createmerch',
//             data: $('#merchandise-new').serialize(),
//             success: function(result){
//                 $newMerchMain =
//                 "<tr>" +
//                     "<td>" + result + "</td>" +
//                     "<td>" + result['result']['name'] + "</td>" +
//                     "<td>" + result['result']['price'] + "</td>" +
//                     "<td>" + result['result']['number'] + "</td>" +
//                     "<td>" + result['result']['number'] + "</td>" +
//                     "<td>" + result['result']['number'] + "</td>" +
//                     "<td>" + result['result']['number'] + "</td>" +
//                     "<td>" + result['result']['number'] + "</td>" +
//                 "</tr>";
//                 $merchListsLabel.innerHTML = $merchListsLabel.innerHTML + $newMerchMain;
//                 console.log(result['result']);
//             }
//         });
//     });
// });
//

function showEditLabel($id, $elem) {
    document.getElementById('merch-'+ $elem + $id.toString()).hidden = true;
    document.getElementById('merch-'+ $elem + 'form-' + $id.toString()).hidden = false;
}
