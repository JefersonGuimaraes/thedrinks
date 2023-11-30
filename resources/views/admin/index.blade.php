@extends('layouts/main-admin')

@section('title', 'Admin | The Drinks')

@section('content')

<div class="row mt-5">
  <div class="col-12">
    <div class="d-flex">
      <h2 class="text-center">Drinks</h2>
      <button class="btn btn-cdx ms-auto me-0" data-bs-toggle="modal" data-bs-target="#newDrinkModal"><span>Novo</span></button>
    </div>
    <div class="table-responsive mt-4">
      <small class="float-end" style="color: #DCDC">Drinks cadastrados: {{count($drinks)}}</small>
      <table class="table table-light table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th scope="col" width="20%" class="ps-4">#</th>
            <th scope="col" width="40%" class="text-center">Nome</th>
            <th scope="col" width="30%" class="text-center">Categorias</th>
            <th scope="col" width="10%" colspan="2" class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($drinks as $drink)
          <tr data-drink="{{json_encode($drink)}}">
            <td class="pe-4">
              <a href="/drink/{{$drink->id}}">
                <img src="/images/drinks/{{$drink->photo}}" alt="{{$drink->name}}" width="50">
              </a>
            </td>
            <td class="pe-4 text-center">
              {{$drink->name}}
            </td>
            <td class="pe-4 text-center">
              @foreach ($drink->categories as $category)
              [{{$category->category}}]
              @endforeach
            </td>
            <td class="text-center">
              <button class="btn-action btn-update"><i class="fa-solid fa-pen-to-square"></i></button>
              <button class="btn-action" onclick='deleteDrink("{{$drink->id}}", "{{$drink->name}}")'><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>

    </div>

  </div>

</div>

<div class="row mt-5 pb-5">

  <div class="col-12">
    <h2>Categorias</h2>
    <div class="table-responsive mt-4">
      <small class="float-end" style="color: #DCDC">Categorias cadastradas: {{count($categories)}}</small>
      <table class="table table-light table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th scope="col" width="95%" class="ps-4">Categoria</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td class="ps-4">{{$category->category}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- Modal new drink-->
<div class="modal fade" id="newDrinkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newDrinkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="/drink" method="POST" enctype="multipart/form-data" id="newDrinkForm">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="newDrinkModalLabel">Novo Drink</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Categorias:</label><br>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxAlcoolico" value="1" data-category="Alcoólico">
              <label class="form-check-label" for="checkboxAlcoolico">Alcoólico</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxBatido" value="2" data-category="Batido">
              <label class="form-check-label" for="checkboxBatido">Batido</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxMexido" value="3" data-category="Mexido">
              <label class="form-check-label" for="checkboxMexido">Mexido</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxMontado" value="4" data-category="Montado">
              <label class="form-check-label" for="checkboxMontado">Montado</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxNaoAlcoolico" value="5" data-category="Não Alcoólico" />
              <label class="form-check-label" for="checkboxNaoAlcoolico">Não Alcoólico</label>
            </div>
            <p class="d-none" id="categoryAlert">Você precisa selecionar pelo menos 1 categoria</p>
          </div>

          <div class="mb-3 row">
            <div class="col mt-3 mt-lg-0">
              <label class="form-label">Ingredientes:</label>
              <textarea name="ingredients" id="ingredients" class="form-control" rows="5" required></textarea>
              <small>Separe os ingredientes com . e não se esqueça de seguir o padrão: quantidade + ingrediente. ex: 30ml de vodka.</small>
            </div>
            <div class="mb-3 mt-5">
              <label for="preparation" class="form-label">Modo de Preparo:</label>
              <textarea name="preparation" id="preparation" class="form-control" rows="7" required></textarea>
              <small>Separe os passos com .</small>
            </div>
          </div>

          <div class="mb-3">
            <label for="photo" class="form-label">Imagem ilustração:</label>
            <img style="max-width: 128px; max-height: 128px; display: block;" src="/images/boxed-bg.jpg">
            <input type="file" name="photo" id="photo" class="form-control mt-2" accept="image/*" required>
            <small>A imagem deve ser quadrada e tamanho máximo 500mb</small>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-cdx-light ms-0 me-auto" data-bs-dismiss="modal"><span>Fechar</span></button>
          <button type="submit" class="btn btn-cdx"><span>Salvar</span></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal update drink -->
<div class="modal fade" id="updateDrinkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDrinkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formUpdateDrink" method="POST" enctype="multipart/form-data" id="updateDrinkForm">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updateDrinkModalLabel">Editar Drink</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="_id" id="idUpdate">
          <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="nameUpdate" class="form-control" value="" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Categorias:</label><br>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxAlcoolicoUpdate" value="1" data-category="Alcoólico" />
              <label class="form-check-label" for="checkboxAlcoolicoUpdate">Alcoólico</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxBatidoUpdate" value="2" data-category="Batido" />
              <label class="form-check-label" for="checkboxBatidoUpdate">Batido</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxMexidoUpdate" value="3" data-category="Mexido" />
              <label class="form-check-label" for="checkboxMexidoUpdate">Mexido</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxMontadoUpdate" value="4" data-category="Montado" />
              <label class="form-check-label" for="checkboxMontadoUpdate">Montado</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="categories[]" class="form-check-input" type="checkbox" id="checkboxNaoAlcoolicoUpdate" value="5" data-category="Não alcoólico" />
              <label class="form-check-label" for="checkboxNaoAlcoolicoUpdate">Não Alcoólico</label>
            </div>
            <p class="d-none" id="categoryAlert">Você precisa selecionar pelo menos 1 categoria</p>
          </div>

          <div class="mb-3 row">
            <div class="col-lg-6 mt-3 mt-lg-0">
              <label class="form-label">Ingredientes:</label>
              <textarea name="ingredients" id="ingredientsUpdate" class="form-control" rows="5">⚬ </textarea>
            </div>
          </div>

          <div class="mb-3 mt-5">
            <label for="preparation" class="form-label">Modo de Preparo:</label>
            <textarea name="preparation" id="preparationUpdate" rows="7" class="form-control">⚬ </textarea>
          </div>

          <div class="mt-5 mb-3">
            <label for="photoUpdate" class="form-label">Imagem ilustração:</label>
            <img style="max-width: 128px; max-height: 128px; display: block;" src="/images/boxed-bg.jpg">
            <input type="file" name="photo" id="photoUpdate" class="form-control mt-2" accept="image/*">
            <small>A imagem deve ser quadrada e tamanho máximo 500mb</small>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-cdx-light ms-0 me-auto" data-bs-dismiss="modal"><span>Fechar</span></button>
          <button type="submit" class="btn btn-cdx"><span>Salvar</span></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal delete drink -->
<div class="modal fade" id="deleteDrinkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteDrinkModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar drink</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center" id="deleteDrinkText"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cdx-light ms-0 me-auto" data-bs-dismiss="modal"><span>Não</span></button>
        <form id="formDeleteDrink" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-cdx"><span>Sim</span></button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="/js/codxfilereader.js"></script>

<script>
  // PREVIEW DA IMAGEM SELECIONADA
  new CODXFileReader("#newDrinkModal [type=file]", "#newDrinkModal img")
  new CODXFileReader("#updateDrinkModal [type=file]", "#updateDrinkModal img");

  // SELECIONANDO FORM UPDATE
  var formUpdate = document.querySelector("#updateDrinkModal form");
  // CHAMANDO MODAL UPDATE E PREENCHENDO CAMPOS
  [...document.querySelectorAll(".btn-update")].forEach(btn => {

    btn.addEventListener('click', e => {
      // ZERANDO OS CHECKBOX DAS CATEGORIAS
      [...document.querySelectorAll("input[name=categories]")].forEach(input => {
        input.checked = false
      })
      // ZERANDO A TABELA DE INGREDIENTES
      let ingredientsTable = document.querySelector('table#table-ingredients-update tbody');
      [...document.querySelectorAll("table#table-ingredients-update tbody tr")].forEach(tr => tr.remove())
      let prepareTable = document.querySelector('table#table-prepare-update tbody');
      [...document.querySelectorAll('table#table-prepare-update tbody tr')].forEach(tr => tr.remove())

      let tr = e.composedPath().find(el => {

        return (el.tagName.toUpperCase() === 'TR')

      })

      // SELECIONANDO TODOS OS CHECKBOX DE CATEGORIAS
      let inputsCategories = [...document.querySelectorAll("input[name='categories[]']")]
      inputsCategories.forEach(input => {
        input.checked = false
      })

      // TRANSFORMANDO OS DADOS DO DATA-DRINK EM UM OBJETO JSON;
      let data = JSON.parse(tr.dataset.drink)
      for (let name in data) {

        switch (name) {

          case 'id_drink':
            let inputId = formUpdate.querySelector('#idUpdate')
            if (inputId) inputId.value = data[name]
          break

          case 'photo':
            formUpdate.querySelector("img").src = "/images/drinks/" + data[name]
          break

          case 'categories':
            let categoriesDrinks = Object.values(data[name])
            categoriesDrinks.forEach(category => {
              inputsCategories.forEach(input => {
                (input.dataset.category == category.category) ? input.checked = true: input.check = false
              })
            })
          break

          case 'ingredients':
            document.querySelector("#ingredientsUpdate").value = data[name]
          break

          case 'preparation':
            document.querySelector("#preparationUpdate").value = data[name]
          break

          default:
            let inputName = formUpdate.querySelector(`[name=${name}]`)
            if (inputName) inputName.value = data[name]
        }

      }

      document.querySelector('#formUpdateDrink').setAttribute('action', `/drink/${data.id}`)
      $('#updateDrinkModal').modal('show')

    })

  })

  // CHAMANDO MODAL DELETE DRINK
  function deleteDrink(id, name) {
    let modalDelete = new bootstrap.Modal(document.querySelector("#deleteDrinkModal"))
    document.querySelector('#deleteDrinkText').innerHTML = `Tem certeza que deseja deletar o drink: <br> <b>${name}<b>?`
    document.querySelector('#formDeleteDrink').setAttribute('action', `/drink/${id}`)
    modalDelete.show()
  }

  // VALIDAÇÃO DA SELEÇÃO DE CATEGORIA NO FORM CREATE
  $('#newDrinkForm').submit(function() {
    if ($('input[name="categories[]"]:checked').length === 0) {
      $('#categoryAlert').removeClass('d-none')
      $('input[name="categories[]"]').focus()
      return false;
    }
  });

  // VALIDAÇÃO DA SELEÇÃO DE CATEGORIA NO FORM UPDATE
  $('#updateDrinkForm').submit(function() {
    if ($('input[name="categories[]"]:checked').length === 0) {
      $('#categoryAlert').removeClass('d-none')
      $('input[name="categories[]"]').focus()
      return false;
    }
  });
</script>

@endsection