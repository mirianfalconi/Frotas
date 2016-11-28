
@foreach ($motorista as $funcionario)
    <option value="{{ $funcionario->nome }}">{{ $funcionario->cargo }}</option>
@endforeach


          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

<script>

$("input[name*='data_emissao']").mask("99/99/9999", {placeholder: 'DD/MM/AAAA' });

</script>
