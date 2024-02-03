<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../crud/addnewstud.php" method="post">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="lrn">LRN</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lrn" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="fname">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fname" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mname">Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mname" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="lname">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="xname">Extension Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="xname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="birth">Birthday</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="birth">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="age">Age</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="age" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="sex">Sex</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mobile">Mobile #</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mobile" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="pob">Place of Birth</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="pob">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="tongue">Mother Tongue</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="tongue">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="strt">Street</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="strt">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="brgy">Barangay</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="brgy">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mncpl">Municipality/City</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mncpl">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="prvnc">Province</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="prvnc">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="cntry">Country</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="cntry">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="ffname">Father's First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="ffname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="fmname">Father's Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fmname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="flname">Father's Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="flname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mfname">Mother's First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mfname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mmname">Mother's Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mmname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mlname">Mother's Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mlname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="gfname">Guardian's First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="gfname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="gmname">Guardian's Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="gmname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="glname">Guardian's Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="glname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="status">Status</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="status">
                                        <option value="Old">Old Student</option>
                                        <option value="New">New Student</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hschool">Previous School</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hschool">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hstrt">School Address (Street)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hstrt">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hbrgy">School Address (Barangay)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hbrgy">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hmncpl">School Address
                                    (Municipality/City)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hmncpl">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hprvnc">School Address (Province)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hprvnc">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hcntry">School Address (Country)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hcntry">
                                </div>
                            </div>



                            <?php
            if (!empty($successMessage)){
                echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                ";
            }
        ?>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="add_newstud" class="btn btn-primary">Add Student</button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>
        </div>