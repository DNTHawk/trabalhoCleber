document.getElementById('profissionais').hidden = true
document.getElementById('centro_medico').hidden = true
document.getElementById('especialidade').hidden = true


function seleciona_form(param) {
  if (param === 'profissionais') {
    document.getElementById('tipo_lista').innerHTML = "Listagem de profissionais"
    document.getElementById('profissionais').hidden = false
    document.getElementById('centro_medico').hidden = true
    document.getElementById('especialidade').hidden = true

  } else if (param === 'centro_medico') {
    document.getElementById('tipo_lista').innerHTML = "Listagem de centro médico"
    document.getElementById('profissionais').hidden = true
    document.getElementById('centro_medico').hidden = false
    document.getElementById('especialidade').hidden = true
  } else {
    document.getElementById('tipo_lista').innerHTML = "Listagem de especialidades"
    document.getElementById('profissionais').hidden = true
    document.getElementById('centro_medico').hidden = true
    document.getElementById('especialidade').hidden = false
  }
}