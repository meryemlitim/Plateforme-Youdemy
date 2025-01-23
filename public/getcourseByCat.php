<div class="font-[sans-serif] overflow-x-auto">
                <table class="min-w-full bg-white">
                  <thead class="whitespace-nowrap">
                    <tr>
                      <th class="p-4 text-left text-sm font-semibold text-black">
                        course id
                      </th>
                      <th class="p-4 text-left text-sm font-semibold text-black">
                        course Title
                      </th>
                      <th class="p-4 text-left text-sm font-semibold text-black">
                        course Type
                      </th>




                    </tr>
                  </thead>

                  <tbody class="whitespace-nowrap">


                    <?php foreach ($getcourseByCat as $course) { ?>

                      <tr class="odd:bg-gray-100">
                        <td class="p-4 text-md font-bold">
                          <?= $course["id_course"]; ?>
                        </td>
                        <td class="p-4 text-sm">
                          <div class="flex items-center cursor-pointer w-max">
                            <div class="ml-4">

                              <p class="text-sm text-black"> <?= $course["title"]; ?> </p>
                            </div>
                          </div>
                        </td>

                        <td class="p-4 text-sm">
                          <div class="flex items-center cursor-pointer w-max">
                            <div class="ml-4">
                              <p class="text-sm text-black"> <?= $course["type"]; ?> </p>
                            </div>
                          </div>
                        </td>





                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="course_video_detail"
                              class="px-4 py-2 flex items-center justify-center gap-2 rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Detail</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                              </svg>


                            </button>
                          </form>

                        </td>
                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="course_video_edit"
                              class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Edit</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 24 24">
                                <path d="M16.707 4.293l-3.997 3.998 4.242 4.243 3.997-3.998a2 2 0 0 0 0-2.828l-2.828-2.828a2 2 0 0 0-2.828 0zM12.414 8.707L11 7.293 4 14.293V17h2.707l7.414-7.414z" />
                              </svg>

                            </button>
                          </form>

                        </td>
                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="deleteCourse"
                              class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Delete</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 320.591 320.591">
                                <path
                                  d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                  data-original="#000000" />
                                <path
                                  d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                  data-original="#000000" />
                              </svg>
                            </button>
                          </form>

                        </td>
                      </tr>




                    <?php } ?>
                    






                  </tbody>
                </table>

              </div>