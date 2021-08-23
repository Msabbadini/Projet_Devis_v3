<?php

function Pagination($nombre_total,$categorie,$page_active=1){
    $limit=LIMIT;
    $last_page = ceil($nombre_total/$limit);
    $html='';
    for($i=1;$i<=$last_page;$i++){
        if($i==$page_active){
           $html.=' <a href="#"  class=" -ml-px relative inline-flex items-center px-4 py-2 border border-indigo-500 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">'.$i.'</a>';

        }else{ 
            $html.='<a href="#" data-categorie="'.htmlentities($categorie).'" data-pagenum="'.$i.'"  class="displayRecords -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">'.$i.'</a>';
        }
    }
    return $html;
}
// $pagination_html = '
// <div align="center">
//       <ul class="pagination">
// ';

// $total_links = ceil($total_data/$limit);

// $previous_link = '';

// $next_link = '';

// $page_link = '';

// if($total_links > 4)
// {
//     if($page < 5)
//     {
//         for($count = 1; $count <= 5; $count++)
//         {
//             $page_array[] = $count;
//         }
//         $page_array[] = '...';
//         $page_array[] = $total_links;
//     }
//     else
//     {
//         $end_limit = $total_links - 5;

//         if($page > $end_limit)
//         {
//             $page_array[] = 1;

//             $page_array[] = '...';

//             for($count = $end_limit; $count <= $total_links; $count++)
//             {
//                 $page_array[] = $count;
//             }
//         }
//         else
//         {
//             $page_array[] = 1;

//             $page_array[] = '...';

//             for($count = $page - 1; $count <= $page + 1; $count++)
//             {
//                 $page_array[] = $count;
//             }

//             $page_array[] = '...';

//             $page_array[] = $total_links;
//         }
//     }
// }
// else
// {
//     for($count = 1; $count <= $total_links; $count++)
//     {
//         $page_array[] = $count;
//     }
// }

// for($count = 0; $count < count($page_array); $count++)
// {
//     if($page == $page_array[$count])
//     {
//         $page_link .= '
//         <li class="page-item active">
//               <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
//         </li>
//         ';

//         $previous_id = $page_array[$count] - 1;

//         if($previous_id > 0)
//         {
//             $previous_link = '<li class="page-item"><a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$previous_id.')">Previous</a></li>';
//         }
//         else
//         {
//             $previous_link = '
//             <li class="page-item disabled">
//                 <a class="page-link" href="#">Previous</a>
//             </li>
//             ';
//         }

//         $next_id = $page_array[$count] + 1;

//         if($next_id >= $total_links)
//         {
//             $next_link = '
//             <li class="page-item disabled">
//                 <a class="page-link" href="#">Next</a>
//               </li>
//             ';
//         }
//         else
//         {
//             $next_link = '
//             <li class="page-item"><a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$next_id.')">Next</a></li>
//             ';
//         }

//     }
//     else
//     {
//         if($page_array[$count] == '...')
//         {
//             $page_link .= '
//             <li class="page-item disabled">
//                   <a class="page-link" href="#">...</a>
//               </li>
//             ';
//         }
//         else
//         {
//             $page_link .= '
//             <li class="page-item">
//                 <a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$page_array[$count].')">'.$page_array[$count].'</a>
//             </li>
//             ';
//         }
//     }
// }

// $pagination_html .= $previous_link . $page_link . $next_link;


// $pagination_html .= '
//     </ul>
// </div>
// ';
?>