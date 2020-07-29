<form method="get" class="search" action="<?php echo home_url('/'); ?>">
	<input name="s" type="text" id="searchfield" name="s" onblur="if(this.value=='')this.value='Aradığınız kelime';" onfocus="if(this.value=='Aradığınız kelime')this.value='';" value="Aradığınız kelime">
	<button type="submit" class="searchSubmit"><i class="material-icons">search</i></button>
</form>
