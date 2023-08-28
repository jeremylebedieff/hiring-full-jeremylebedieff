 import { useState } from 'react';
import './CardProfil.css';


export const CardProfil = (props: any):any => {
    const { value, checkAll } = props;
    const [nbCheck, setNbChecked] = useState<number>(3);
    console.log(value, checkAll)
    return (
        <div id='Card' className='row' >
            <div className='columnCheck'>
                <input type='checkbox'
                className='checkBox' 
                checked={checkAll}
                onClick={() => {
                    
                }} />
            </div>
            <div className='columnInfo'>
                <div id='CardHeader'>
                    <img className='avatar' alt="avatar" src={value.avatar_url} />
                    
                </div>
                <div id='CardContent'>
                    <h5>{value.id}</h5>
                    <h6>{value.login}</h6>
                    
                </div>
                <div id='CardAction'>
                    <button id='ViewProfilBtn'><a href={value.html_url}>click ici </a></button>
                </div>
            </div>
            <div className='column'></div>
        </div>
    )
}