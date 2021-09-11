<?php

// function Pagination($nombre_total,$categorie,$page=1){
//     $limit=LIMIT;
//     $last_page = ceil($nombre_total/$limit);
//     $html='';
//     for($i=1;$i<=$last_page;$i++){
//         if($i==$page){
//            $html.=' <a href="#"  class=" -ml-px relative inline-flex items-center px-4 py-2 border border-indigo-500 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">'.$i.'</a>';

//         }else{ 
//             $html.='<a href="#" data-categorie="'.htmlentities($categorie).'" data-pagenum="'.$i.'"  class="displayRecords -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">'.$i.'</a>';
//         }
//     }
//     return $html;
// }
//  trouver le style disabled
function Pagination($nombre_total,$categorie,$page=1){
    $limit=LIMIT;

        $last_page = ceil($nombre_total/$limit);

        $previous_link = '';

        $next_link = '';

        $page_link = '';
        $page_array= [];
        if($last_page > 4)
        {
            if($page < 5)
            {
                for($count = 1; $count <= 5; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $last_page;
            }
            else
            {
                $end_limit = $last_page - 5;

                if($page > $end_limit)
                {
                    $page_array[] = 1;

                    $page_array[] = '...';

                    for($count = $end_limit; $count <= $last_page; $count++)
                    {
                        $page_array[] = $count;
                    }
                }
                else
                {
                    $page_array[] = 1;

                    $page_array[] = '...';

                    for($count = $page - 1; $count <= $page + 1; $count++)
                    {
                        $page_array[] = $count;
                    }

                    $page_array[] = '...';

                    $page_array[] = $last_page;
                }
            }
        }
        else
        {
            for($count = 1; $count <= $last_page; $count++)
            {
                $page_array[] = $count;
            }
        }

        for($count = 0; $count < count($page_array); $count++)
        {
            if($page == $page_array[$count])
            {
                    $page_link.=' <a href="#"  class=" -ml-px relative inline-flex items-center px-4 py-2 border border-indigo-500 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">'.$page_array[$count].'</a>';

                $previous_id = $page_array[$count] - 1;

                if($previous_id > 0)
                {
                    $previous_link='<a href="#" data-categorie="'.htmlentities($categorie).'" data-pagenum="'.$previous_id.'"  class="displayRecords -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"> < </a>';

                }
                else
                {
                    // $previous_link='<a href="#" class="disabled -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"> < </a>';
                    $previous_link='';
                }

                $next_id = $page_array[$count] + 1;

                if($next_id > $last_page)
                {
                    // $next_link='<a href="#" class="disabled -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"> > </a>';
                    $next_link='';
                }
                else
                {
                    // page suivante
                    $next_link='<a href="#" data-categorie="'.htmlentities($categorie).'" data-pagenum="'.$next_id.'"  class="displayRecords -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"> > </a>';

                }

            }
            else
            {
                if($page_array[$count] == '...')
                {
                    $page_link.='<a href="#" class="disabled -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"> ... </a>';

                }
                else
                {
                    $page_link.='<a href="#" data-categorie="'.htmlentities($categorie).'" data-pagenum="'.$page_array[$count].'"  class="displayRecords -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">'.$page_array[$count].'</a>';

                }
            }
        }

        $html = $previous_link . $page_link . $next_link;
        return $html;
}
?>