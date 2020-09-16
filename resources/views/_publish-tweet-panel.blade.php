<div class="border border-blue-400 rounded-lg py-6 px-8 mb-8">
  <form action="/tweets" method="post" enctype="multipart/form-data">

    @csrf
    <textarea
      name="body"
      class="w-full px-2"
      placeholder="What's up doc?"
      required
      autofocus
    ></textarea>

    <input type="file" name="photo" class="my-2" id="tweet-photo">


      <img src="#" id="photo-prev" style="display:none;">

    <hr class="my-4">

    <footer class="flex justify-between items-center">

      <img
          src="{{ auth()->user()->avatar }}"
          alt="your avatar"
          class="rounded-full mr-2"
          width="50"
          height="50"
      >

      <button
          type="submit"
          class="bg-blue-500 rounded-lg shadow py-2 px-10 text-sm text-white hover:bg-blue-600"
          >
          Publish
      </button>

    </footer>

  </form>

  @error('body')
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
  @enderror
</div>
<script>
    $("#tweet-photo").change(function(event){
        //console.log(URL.createObjectURL(event.target.files[0]))

        $("#photo-prev").show().attr('src', URL.createObjectURL(event.target.files[0]))
    })
</script>
