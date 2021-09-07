
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal_id">
  <div class="relative w-9/12 h-9/12 my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h3 class="text-3xl font-semibold">
          Modification
        </h3>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
          <span class=" bg-black  opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
          <i class="uil uil-times-square"></i>
          </span>
        </button>
      </div>
      <!--body-->
      <div id='modal_content' class="relative p-6 flex-auto">
      <?php 
        if(isset($modal_content) && !empty($modal_content)){
          $nom_modal='modals/modal_'.$modal_content.'.php';
            if(file_exists($nom_modal)){
              include $nom_modal;
            }else{
              echo 'page introuvable';
            }
        }
      ?>
      </div>
      <!--footer-->
      <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
        <button data-modal='modal_id' class="close text-white bg-indigo-600 hover:bg-red-500 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" rel="modal:close"  type="button">
          Fermer
        </button>
        <button id='modif' class=" text-white bg-indigo-600 hover:bg-green-500 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit" >
          Modifier
        </button>
      </div>
    </div>
  </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal_id_backdrop"></div>
