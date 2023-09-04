import React, {useEffect, useRef, useState} from 'react';
import {View, Text, TouchableHighlight, FlatList, TextInput, ScrollView, StyleSheet, Dimensions} from 'react-native';
import {useNavigation} from "@react-navigation/native";
import { LinearGradient } from 'expo-linear-gradient';


const {height, width} = Dimensions.get('window');
const HelloWorld = (nav) => {
    const navi = useNavigation();

    const timeBeforeWord = [
        {id: 1, name: '2'},
        {id: 2, name: '5'},
        {id: 3, name: '10'},
    ];
    const gameTimes = [

        {id: 4, name: '10'},
        {id: 5, name: '30'},
        {id: 6, name: '60'},
        {id: 7, name: '90'}
    ];

    const [selectedId, setSelectedId] = React.useState(2);
    const [selectedIdGameTime, setSelectedIdGameTime] = React.useState(5);
    const [beforeWord, setBeforeWord] = React.useState(5100);
    const [gameTime, setGameTime] = React.useState(30);
    const [player1, setPlayer1] = useState('Player1');
    const [player2, setPlayer2] = useState('Player2');

    const handleStartPress = () => {
        navi.navigate("     ", {
            wordTime: beforeWord,
            gameTime: gameTime,
            player1: player1,
            player2: player2
        })
    };

    const handleBeforeWordPress = beforeWord => {
        setBeforeWord(beforeWord.name * 1000 + 500);
        setSelectedId(beforeWord.id ? beforeWord.id : "2");
    };
    const handleGameTimePress = gameTime => {
        setGameTime(gameTime.name);
        setSelectedIdGameTime(gameTime.id ? gameTime.id : "5")
    };

    const renderBeforeWord = ({item}) => {
        const color = item.id === selectedId ? 'yellow' : '#815482';
        return (
            <TouchableHighlight onPress={() => handleBeforeWordPress(item)}>
                <Text style={{color, backgroundColor:'transparent', padding: 10, marginHorizontal: 10, fontSize: 38 }}>
                    {item.name}
                </Text>
            </TouchableHighlight>
        );
    };
    const renderGameTime = ({item}) => {
        const color = item.id === selectedIdGameTime ? 'yellow' : '#815482';
        return (
            <TouchableHighlight onPress={() => handleGameTimePress(item)}>
                <Text style={{color, backgroundColor:'transparent', padding: 10, marginHorizontal: 10, fontSize: 38 }}>
                    {item.name}
                </Text>
            </TouchableHighlight>
        );
    };

    return (
        <View style={styles.container}>
            <LinearGradient
                // Background Linear Gradient
                colors={['rgba(63,15,64,0.9)', 'transparent']}
                style={styles.background}
            />
            <View style={{marginVertical: 20}}>
                <Text style={styles.text}>Temps avant le prochain mot</Text>
                <FlatList
                    horizontal={true}
                    data={timeBeforeWord}
                    renderItem={renderBeforeWord}
                    keyExtractor={beforeWord => beforeWord.id}
                />
            </View>
            <View style={{marginVertical: 20}}>
                <Text style={styles.text}>Temps de passage</Text>
                <FlatList
                    horizontal={true}
                    data={gameTimes}
                    renderItem={renderGameTime}
                    keyExtractor={TimePlayed => TimePlayed.id}
                />
            </View>
            <View style={{marginVertical: 20}}>
                <Text style={styles.text}>Équipes :</Text>
                <TextInput
                    style={styles.input}
                    onChangeText={(text) => setPlayer1(text)}
                    value={player1}
                />
                <TextInput
                    style={styles.input}
                    onChangeText={(text) => setPlayer2(text)}
                    value={player2}
                />
            </View>
            <View>
                <TouchableHighlight onPress={handleStartPress}  style={styles.mainButton}>
                    <Text style={styles.mainButtonText}>START</Text>
                </TouchableHighlight>
            </View>     
        </View>
    );
};

export default HelloWorld;


const styles = StyleSheet.create({
    button: {
        backgroundColor: '#000',
        borderRadius: 25,
        marginBottom: 50,
        padding: 10,
        alignItems: 'center',
    },
    container: {
        flex: 1,
        backgroundColor: "#0c030c",
    },
    buttonText: {
        color: '#fff',
        fontWeight: 'bold',
    },
    text :{
        color: "white",
    },
    mainButton: {
        shadowColor: 'rgba(75,15,77, .4)', // IOS
        shadowOffset: {height: 10, width: 10}, // IOS
        shadowOpacity: 1, // IOS
        shadowRadius: 1, //IOS
        elevation: 1, //Android (don't work)
        position: 'absolute',
        alignSelf: 'center',
        backgroundColor: 'yellow',
        padding: 15,
        borderRadius: 25
    },
    mainButtonText: {
        color: 'black',
        fontWeight: 'bold',
        textAlign: 'center',
        fontSize: 20
    },
    input: {
        borderWidth: 1,
        color: "#5b375b",
        borderColor: 'transparent',
        borderRadius: 5,
        padding: 10,
        fontSize: 38
    },
    background: {
        position: 'absolute',
        left: 0,
        right: 0,
        top: 0,
        height: 900,
    },
    flatlist: {
        underlayColor: 'blue',
        marginVertical: 20,
    },
});
