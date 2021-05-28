const btnsEdit = document.querySelectorAll("#btnEditWine");
btnsEdit.forEach((elem) => {
  elem.addEventListener("click", () => {
    // console.log(elem.dataset.id);

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          const res = JSON.parse(xhr.response);

          const form = document.querySelector("#modalEditWine form");
          const name = document.querySelector("#modalEditWine form #name");
          const country = document.querySelector(
            "#modalEditWine form #country"
          );
          const region = document.querySelector("#modalEditWine form #region");
          const millesime = document.querySelector(
            "#modalEditWine form #millesime"
          );
          const cepages = document.querySelector(
            "#modalEditWine form #cepages"
          );
          const description = document.querySelector(
            "#modalEditWine form #description"
          );

          name.value = res.name;
          country.value = res.country;
          region.value = res.region;
          millesime.value = res.millesime;
          cepages.value = res.cepages;
          description.value = res.description;
          //
          //On modifie l'attribut action du formulaire d'edition pour injecter l'id de la bouteille séléctionné
          let splitAction = form.getAttribute("action").split("/");
          splitAction[splitAction.length - 1] = elem.dataset.id;
          const action = splitAction.join("/");
          form.setAttribute("action", action);
        }
      }
    };

    let dataSend = new FormData();
    dataSend.append("idBottle", elem.dataset.id);
    xhr.open("post", `/admin/wine/get/${elem.dataset.id}`, true);
    xhr.send(dataSend);
  });
});
