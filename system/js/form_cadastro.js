// document.getElementById('botao_listar').hidden = true
document.getElementById('form_centro_medico').hidden = true
document.getElementById('form_profissional').hidden = true
document.getElementById('form_especialidades').hidden = true


function seleciona_form(param) {
  if (param === 'centro_medico') {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de centro médico"
    document.getElementById('form_centro_medico').hidden = false
    document.getElementById('form_profissional').hidden = true
    document.getElementById('form_especialidades').hidden = true

  } else if (param === 'profissional') {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de profissional"
    document.getElementById('form_centro_medico').hidden = true
    document.getElementById('form_profissional').hidden = false
    document.getElementById('form_especialidades').hidden = true
  } else {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de especialidades"
    document.getElementById('form_centro_medico').hidden = true
    document.getElementById('form_profissional').hidden = true
    document.getElementById('form_especialidades').hidden = false
  }
}