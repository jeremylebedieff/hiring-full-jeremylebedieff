import { useState } from 'react';
 //import TextField from '@mui/material/TextField';
import { ListCard } from '../ListCard/ListCard';
import './InputSearch.css';
import researchResult from '../../interfaces';


export const InputSearch = () => {
    //
    const [users, setUsers] = useState<researchResult>();
    const [search, setSearch] = useState<string>();
   const [checkAll, setCheckAll] = useState<number>(0);
    const [nbrChecked, setNbrChecked] = useState<number>(0);
    const research = (e: any) => {
        const searchValue = e.target.value;
        const url =`https://api.github.com/search/users?q=${searchValue}`
        setSearch(searchValue);
        
        // Fetch API with url 
        fetch(url)
        .then((res) => res.json())
        .then((data) => {
                setUsers(data);
            })
            .catch((err) => {
                console.log(err.message);
        });
    }
    
    return (
        <div>           
            <input id='inputSearch'
            placeholder='votre recherche ici'
            className='checkBox' 
            onChange={research}
            
            />
            {/* Step Bonus */}
            <div className='row'>
                <div className='column'>
                    <input type='checkbox' 
                    onClick={() => { setCheckAll(users?.items.length) }}   
                    />
                    <label><b>{nbrChecked} element{ nbrChecked > 0 ? 's' : ''} selected</b></label>
                </div>
                <div className='column'></div>
                <div className='column'>
                    {
                    <button><i className="fa fa-trash"></i></button> }
                </div>
            </div>
            <div id='boxList' className='flex'>
                <ListCard items={users?.items}
                    checkedAll={checkAll} 
                    search={search}
                />
            </div>
        </div>
    )
}

