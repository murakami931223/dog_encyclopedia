@foreach ($dogs as $dog)
                <div class="flex-column dog-card" data-name="{{ $dog->dog_name }}"
                                                    data-size="{{ $dog->size_id }}"
                                                    data-viewCounts="{{ $dog->view_count }}">
                    <div class="dog-item">
                        @auth
                        <div class="usually-article-favorite-box">
                            @if (!Auth::user() -> is_favorite($dog -> id))
                                <span class="favorite-judge">
                                    <i class="far fa-heart favorite-toggle" data-dog_id="{{ $dog->id }}"></i>
                                </span>
                            @else
                                <span class="favorite-judge">
                                    <i class="fas fa-heart favorite-toggle" data-dog_id="{{ $dog->id }}"></i>
                                </span>
                            @endif
                        </div>
                        @endauth
                        <a class="dog-article" href="{{ route('article', ['id' => $dog -> id]) }}">
                            <img src="{{ asset($dog->dog_img) }}">
                            <p class="dog-name">{{ $dog->dog_name }}</p>
                        </a>
                    </div>
                    @if(auth()->user()?->is_admin)
                    <div class="delete-area">
                        <form action="{{ route('admin.delete', ['id' => $dog -> id ]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input data-dog_id="{{ $dog->id }}" class="delete-btn-primary list-delete-btn" type="submit" value = "削除" >
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach