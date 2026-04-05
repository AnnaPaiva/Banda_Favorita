<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Jorge e Mateus - Oficial</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Exercicio Final" />
  <meta name="author" content="Anna Gabriela" />
  <meta name="keywords" content="Jorge, Mateus, Discografia, Fotos, Agenda, contatos, banda" />

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />

  <!-- Fontes e icons -->
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/1ce6cd5a3e.js" crossorigin="anonymous"></script>

  <!-- Lightbox CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css" rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/meu-ficheiro.css" />
</head>

<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-sm-10 nav navbar">
          <img src="photos/Logo.jpg" alt="logo" class="logo" width="75px" />
          <a href="#" class="nav-link p-3 m-2" title="Search"><i class="fa fa-search"></i></a>

          <a href="index.php" class="nav-link active p- m-2">HOME</a>
          <a href="SOBRE.html" class="nav-link p-2 m-2">SOBRE</a>
          <a href="loja.php" class="nav-link p-2 m-2">LOJA</a>
          <a href="AGENDA.html" class="nav-link p-2 m-2">AGENDA</a>
          <a href="contacto.html" class="nav-link p-2 m-2">CONTACTOS</a>
          <a href="carrinho.php" class="nav-link p-1 m-2">
            <i class="fa fa-shopping-cart"></i></a>

          <div class="col-sm-4 dropdown">
            <a class="btn btn-outline-light dropdown-toggle" href="#" role="button"
              data-bs-toggle="dropdown">Mais</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Discografia</a>
              <a class="dropdown-item" href="#">Fotos</a>
              <a class="dropdown-item" href="#">Shows</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <section>
      <div class="container-fluid" style="max-width: 2000px; margin-top: 46px">
        <div id="carousel" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="photos/JeM.jpg" class="d-block w-100" alt="Jorge e Mateus" />
              <div class="carousel-caption d-none d-md-block">
                <h3>Goiânia</h3>
                <p>Minha cidade, meu amor! Muito Obrigado!</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="photos/JeM4.jpg" class="d-block w-100" alt="Jorge e Mateus" />
              <div class="carousel-caption d-none d-md-block">
                <h3>Caldas Novas</h3>
                <p>Terra maravilhosa, foi lindo Caldas, obrigado</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="photos/JeM5.jpg" class="d-block w-100" alt="Jorge e Mateus" />
              <div class="carousel-caption d-none d-md-block">
                <h3>Brasília</h3>
                <p>Inesquecível, obrigado!</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
    </section>
    <article>
      <div class="container-fluid" id="band">
        <h2 class="display-3 text-center text-black">A Banda</h2>
        <p class="h1 text-center text-black">
          <i>JORGE & MATEUS, A DUPLA QUE CONQUISTOU O BRASIL</i>
        </p>
        <p class="h3 text-center text-black">
          Foi através de um amigo em comum, em 2005, que Jorge, estudante de
          Direito que participava de muitos festivais de música, e Mateus, que
          cursava Agronomia e também se apresentava em festas e festivais,
          tiveram a oportunidade de cantar juntos em um churrasco. A sintonia
          foi tão forte que passaram a fazer shows como dupla. O primeiro foi
          em 26 de maio de 2005, em Itumbiara. Em 2007 nascia o primeiro
          CD/DVD “Ao Vivo Em Goiânia”, pela gravadora Universal Music. A
          repercussão foi tão imediata que além de ver seu primeiro sucesso,
          “Pode Chorar”, estourar no Brasil, ganharam disco de ouro e
          começaram a construir sua história.
        </p>
        <br />
        <div class="row">
          <div class="col-sm-4 text-center">
            <p class="h3 text-black">Jorge e Mateus</p>
            <img src="photos/cards.jpg" class="round" alt="JeM" style="width: 60%" />
          </div>
          <div class="col-sm-4 text-center">
            <p class="h3 text-black">Jorge e Mateus</p>
            <img src="photos/cards2.jpg" class="round" alt="JeM" style="width: 80%" />
          </div>
          <div class="col-sm-4 text-center">
            <p class="h3 text-black">Jorge e Mateus</p>
            <img src="photos/cards3.jpg" class="round" alt="JeM" style="width: 80%" />
          </div>
        </div>
      </div>
    </article>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 px-5">
            <div class="black" id="tour">
              <h2 class="display-2 text-center text-white">DATAS DA TURNÊ</h2>
              <p class="h2 text-center text-white">
                Não esqueça de reservar seu ingresso!
              </p>
              <ul class="border text-white list-unstyled text-center" id="lista-turne"></ul>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-sm-3 card mx-auto d-block">
            <img src="photos/show.jpg" class="card-img-top" id="card-city1" alt="Goiânia" />
            <div class="card-body">
              <h5 class="card-title" id="card-text1">Goiânia</h5>
              <p class="card-text text-secondary">
                Sexta-Feira, 5 de Setembro de 2025.
              </p>
              <a href="#" class="btn btn-primary">Comprar Ingressos</a>
            </div>
          </div>
          <div class="col-sm-3 card mx-auto d-block">
            <img src="photos/Show2.jpg" class="card-img-top" id="card-city2" alt="Caldas Novas" />
            <div class="card-body">
              <h5 class="card-title" id="card-text2">Caldas Novas</h5>
              <p class="card-text text-secondary">
                Sábado, 6 de Setembro de 2025.
              </p>
              <a href="#" class="btn btn-primary">Comprar Ingressos</a>
            </div>
          </div>
          <div class="col-sm-3 card mx-auto d-block">
            <img src="photos/Show3.webp" class="card-img-top" id="card-city3" alt="São Paulo" />
            <div class="card-body">
              <h5 class="card-title" id="card-text3">São Paulo</h5>
              <p class="card-text text-secondary">
                Domingo, 7 de Setembro de 2025.
              </p>
              <a href="#" class="btn btn-primary">Comprar Ingressos</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container p-5" id="contact">
        <h2 class="text-center text-white display-3">CONTACTO</h2>
        <p class="text-center text-white"><i>Fãs? Deixe um comentário!</i></p>
        <div class="row">
          <div class="col-sm-6 p-5 text-center text-white">
            <i class="fa fa-map-marker" style="width: 30px"></i> Goiânia,
            GO<br />
            <i class="fa fa-phone" style="width: 30px"></i> Fone: +55
            (62)9999-9999<br />
            <i class="fa fa-envelope" style="width: 30px"></i> Email:
            jorge-mateus.com<br />
          </div>
          <div class="col-sm-6 p-5">
            <form class="row g-3 needs-validation" novalidate>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label text-white">Nome</label>
                <input type="text" class="form-control" id="validationCustom01" value=" " required />
                <div class="valid-feedback">Muito bem!</div>
              </div>
              <div class="col-md-4">
                <label for="validationCustom02" class="form-label text-white">Apelido</label>
                <input type="text" class="form-control" id="validationCustom02" value=" " required />
                <div class="valid-feedback">Muito bem!</div>
              </div>
              <div class="col-md-4">
                <label for="validationBirthday" class="form-label text-white">Data de Nascimento</label>
                <input type="date" class="form-control" id="validationBirthday" value=" " required />
                <div class="valid-feedback">Muito bem!</div>
              </div>
              <div class="col-md-4">
                <label for="validationCustomUsername" class="form-label text-white">E-mail</label>
                <input type="text" class="form-control" id="validationCustomUsername" value="@gmail"
                  required />
                <div class="invalid-feedback">
                  Por favor, insira um e-mail.
                </div>
              </div>
              <div class="col-md-4">
                <label class="form-label text-white">Telefone</label>
                <input type="tel" class="form-control" id="validationPhone" value="+351" />
                <div class="invalid-feedback">
                  Por favor, insira um telefone.
                </div>
              </div>
              <div class="col-12">
                <label for="validationCustom03" class="form-label text-white">Mensagem</label>
                <input type="text" class="form-control" id="validationCustom03" required />
                <div class="invalid-feedback">
                  Por favor, insira uma mensagem.
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container p-4">
      <div class="text-center">
        <a href="http://maps.app.goo.gl/kAfsgEchj6GiSrw26" target="_blank"
          class="btn btn-primary">Localização</a>
      </div>
    </div>
    <div class="container text-center text-white">
      <a href="https://www.facebook.com/jorgeemateus" target="_blank">
        <i class="fa fa-facebook-official hover-opacity"></i>
      </a>

      <a href="https://www.instagram.com/jorgeemateus" target="_blank">
        <i class="fa fa-instagram hover-opacity"></i>
      </a>

      <a href="https://www.snapchat.com/add/jorgeemateus" target="_blank">
        <i class="fa fa-snapchat hover-opacity"></i>
      </a>
      <a href="https://www.pinterest.com/jorgeemateus/" target="_blank">
        <i class="fa fa-pinterest-p hover-opacity"></i>
      </a>
      <a href="https://twitter.com/jorgeemateus" target="_blank">
        <i class="fa fa-twitter hover-opacity"></i>
      </a>
      <a href="https://www.linkedin.com/company/jorge-e-mateus/" target="_blank">
        <i class="fa fa-linkedin hover-opacity"></i>
      </a>
      <br />
      <div>
        Copyright &copy; 2025 Anna Gabriela. Todos os direitos reservados.
      </div>
    </div>
  </footer>

  <!-- jQuery (se precisar) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>

  <!-- Lightbox (opcional) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox-plus-jquery.js"
    crossorigin="anonymous"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>

  <script>
    // Validação do formulário de contato
    (() => {
      "use strict";
      const forms = document.querySelectorAll(".needs-validation");
      Array.from(forms).forEach((form) => {
        form.addEventListener(
          "submit",
          function(event) {
            event.preventDefault(); // evita enviar
            if (!form.checkValidity()) {
              event.stopPropagation();
              alert(
                "Por favor, preencha todos os campos obrigatórios corretamente."
              );
            } else {
              alert("Formulário enviado com sucesso!");
              form.reset();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    })();
  </script>

  <script>
    // Carregar dados da turnê do arquivo agenda.json
    fetch("data/agenda.json")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Erro ao carregar agenda.json");
        }
        return response.json();
      })
      .then((data) => {
        const lista = document.getElementById("lista-turne");
        lista.innerHTML = ""; // limpa antes de preencher

        data.turne.forEach((item) => {
          const li = document.createElement("li");
          li.classList.add("mb-3"); // espaçamento entre os itens
          li.innerHTML = `
          🎤 ${item.mes} - ${item.status}
          ${
            item.status === "Disponível"
              ? `<br><a href="loja.php" class="btn btn-success btn-sm mt-2">Comprar</a>`
              : `<br><button class="btn btn-secondary btn-sm mt-2" disabled>Indisponível</button>`
          }
        `;
          lista.appendChild(li);
        });
      })
      .catch((error) => {
        console.error("Erro:", error);
      });
  </script>

  <!-- JavaScript -->
  <script src="js/meu-ficheiro.js"></script>
</body>

</html>