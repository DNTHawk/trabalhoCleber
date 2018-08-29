document.getElementById('usuarios').hidden = true
document.getElementById('centro_medico').hidden = true
document.getElementById('imagens').hidden = true


function seleciona_form(param) {
  if (param === 'usuarios') {
    document.getElementById('tipo_lista').innerHTML = "Listagem de usuários"
    document.getElementById('usuarios').hidden = false
    document.getElementById('centro_medico').hidden = true
    document.getElementById('imagens').hidden = true

  } else if (param === 'centro_medico') {
    document.getElementById('tipo_lista').innerHTML = "Listagem de centro médico"
    document.getElementById('usuarios').hidden = true
    document.getElementById('centro_medico').hidden = false
    document.getElementById('imagens').hidden = true
  } else {
    document.getElementById('tipo_lista').innerHTML = "Listagem de imagens do carousel"
    document.getElementById('usuarios').hidden = true
    document.getElementById('centro_medico').hidden = true
    document.getElementById('imagens').hidden = false
  }
}