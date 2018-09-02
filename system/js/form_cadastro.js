// document.getElementById('botao_listar').hidden = true
document.getElementById('form_centro_medico').hidden = true
document.getElementById('form_profissional').hidden = true
document.getElementById('form_especialidades').hidden = true
document.getElementById('form_paciente').hidden = true


function seleciona_form(param) {
  console.log(param)
  if (param === 'centro_medico') {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de Centro Médico"
    document.getElementById('form_centro_medico').hidden = false
    document.getElementById('form_profissional').hidden = true
    document.getElementById('form_especialidades').hidden = true
    document.getElementById('form_paciente').hidden = true

  } else if (param === 'profissional') {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de Profissional"
    document.getElementById('form_centro_medico').hidden = true
    document.getElementById('form_profissional').hidden = false
    document.getElementById('form_especialidades').hidden = true
    document.getElementById('form_paciente').hidden = true

  } else if (param === 'especialidade') {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de Especialidades"
    document.getElementById('form_centro_medico').hidden = true
    document.getElementById('form_profissional').hidden = true
    document.getElementById('form_especialidades').hidden = false
    document.getElementById('form_paciente').hidden = true

  } else {
    document.getElementById('tipo_cadastro').innerHTML = "Cadastro de Pacientes"
    document.getElementById('form_centro_medico').hidden = true
    document.getElementById('form_profissional').hidden = true
    document.getElementById('form_especialidades').hidden = true
    document.getElementById('form_paciente').hidden = false

  }
}