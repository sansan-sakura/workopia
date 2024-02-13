
 
 <?= loadPartial('head')?>
<?= loadPartial('navbar')?>
<?= loadPartial('top-banner')?>

    <!-- Post a Job Form Box -->
    <section class="flex justify-center items-center mt-20">
      <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
        <!-- <div class="message bg-red-100 p-3 my-3">This is an error message.</div>
        <div class="message bg-green-100 p-3 my-3">
          This is a success message.
        </div> -->
        <form method="POST" action="/listings/<?=$listing->id?>">
        <input type="hidden" name="_method" value="PUT"/> 
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
            Job Info
            <?php if(isset($errors)):?>
              <?php foreach($errors as $error):?>
                <div class="bg-red-100 message my-3"><?=$error?></div>
              <?php endforeach;?>
              <?php endif;?>
          </h2>
          <div class="mb-4">
            <input
              type="text"
              name="title"
              placeholder="Job Title"
              value='<?=$listing->title??""?>'
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <textarea
              name="description"
              value='<?=$listing->description??""?>'
              placeholder="Job Description"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            ></textarea>
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="salary"
              placeholder="Annual Salary"
              value='<?=$listing->salary??""?>'
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="requirements"
              placeholder="Requirements"
              value='<?=$listing->requirements??""?>'
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="benefits"
              value='<?=$listing->benefits??""?>'
              placeholder="Benefits"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
            Company Info & Location
          </h2>
          <div class="mb-4">
            <input
              type="text"
              name="company"
              value='<?=$listing->company??""?>'
              placeholder="Company Name"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="address"
              placeholder="Address"
              value='<?=$listing->address??""?>'
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="city"
              placeholder="City"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="state"
              placeholder="State"
              value='<?=$listing->state??""?>'
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="phone"
              placeholder="Phone"
              value='<?=$listing->phone??""?>'
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="email"
              name="email"
              value='<?=$listing->email??""?>'
              placeholder="Email Address For Applications"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <button
            class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
          >
            Save
          </button>
          <a
            href="/listings/<?=$listing->id?>"
            class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none"
          >
            Cancel
          </a>
        </form>
      </div>
    </section>




<?= loadPartial('bottom-banner')?>
    <?= loadPartial('footer')?> 